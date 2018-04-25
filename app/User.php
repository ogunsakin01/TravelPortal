<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',  'first_name', 'last_name', 'other_name',
        'date_of_birth', 'email',  'phone_number',
        'address', 'gender', 'password', 'account_status',
        'agency_name', 'agency_id', 'office_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $active = 1;

    public $inactive = 0;

    public static function getUserByEmail($email)
    {
        $user = static::where('email', $email)->first();

        if(is_null($user) || empty($user)){
            return "0";
        }
        else{
            return $user;
        }

    }

    public static function getUserById($id)
    {
        $user = static::where('id', $id)->first();
        if(is_null($user) || empty($user)){
            return "0";
        }
        else{
            return $user;
        }

    }

    public function generateRandomPassword()
    {
        $password = str_random(8);

        return $password;
    }

    public function hashPassword($password)
    {
        return Hash::make($password);
    }

    public function storeUser($data)
    {
        $password = $this->generateRandomPassword();

        $user = static::updateOrCreate(
            [
                'email' => $data['email']
            ],

            [
                'title' => $data['title'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'other_name' => $data['other_name'],
                'date_of_birth' => $data['date_of_birth'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'account_status' => $data['account_status'],
                'email' => $data['email'],
                'password' => $this->hashPassword($password),
                'agency_name' => $data['agency_name'],
                'agent_id' => $data['agent_id'],
                'office_number' => $data['office_number']
            ]
        );


        if ($user)
        {
            $wallet = new Wallet();

            $wallet->createWallet($user->id);

            $role = Role::where('id', $data['role'])->first();

            $user->detachRole($role);
            $user->attachRole($role);

            return true;
        }

        return false;
    }

    public function fetch()
    {
        return static::orderBy('created_at', 'ASC')->get();
    }

    public function status($status)
    {
        if ($status ==  1)
        {
            return '<span class="badge badge-success"><i class="fa fa-check"></i>&nbsp;ACTIVE</span>';
        }
        elseif ($status == 0)
        {
            return '<span class="badge badge-danger"><i class="fa fa-times"></i>&nbsp;INACTIVE</span>';
        }
    }

    public function destroys($id)
    {
        if (static::where('id', $id)->delete())
        {
            return true;
        }

        return false;
    }

    public function fetchUserById($id)
    {
        return static::where('id', $id)->first();
    }

    public function checkLogin()
    {
        if (auth()->check())
        {
            return redirect()->route('backend-home');
        }
        else
        {
            return view('backend.auth.login');
        }
    }

    public function ifUserExists(array $data)
    {
        $user = static::where('email', $data['email'])->first();

        if(is_null($user) || empty($user))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function comparePasswordHash(array $data)
    {
        $user = static::where('email', $data['email'])->first();

        if(Hash::check($data['password'], $user->password))
        {
            return true;
        }
        return false;
    }

    public function ifPasswordExists(array $data)
    {
        $user = static::where('email', $data['email'])->first();

        if($user->password == $data['password'])
        {
            return true;
        }

        return false;
    }

    public function checkAccountStatus(array $data)
    {
        $user = static::where('email', $data['email'])->first();

        if($user->account_status == $this->active)
        {
            return true;
        }
        return false;
    }

    public function authenticateUser(array $data)
    {
        if ($this->ifUserExists($data))
        {
            if ($this->comparePasswordHash($data))
            {
                if ($this->checkAccountStatus($data))
                {
                    /*
                     * Authenticate user
                     * */
                    $response = 1;

                    $user = static::where('email', $data['email'])->first();

                    auth()->login($user);

                    return response()->json($response);
                }
                else
                {
                    /*
                     * Return user back. user has been blocked
                     * */
                    $response = 2;

                    return response()->json($response);
                }
            }
            else
            {
                /*
                 * Return user back. Incorrect email/ password
                 * */
                $response = 0;

                return response()->json($response);
            }
        }
        else
        {
            /*
             * Return user back. Incorrect email/ password
             * */
            $response = 0;

            return response()->json($response);
        }
    }

    public function checkPasswordResetEmail(array $data)
    {
        if ($this->ifUserExists($data))
        {
            try
            {
                Mail::to($data['email'])->send(new PasswordResetLink($data['email']));

                $response = 1;

                return response()->json($response);
            }
            catch (\Exception $e)
            {
                $response = 0;

                return response()->json($response);
            }
        }
        else
        {
            $response = 0;

            return response()->json($response);
        }
    }

    public function getFirstNameByEmail($email)
    {
        return static::where('email', $email)->first()->first_name;
    }

    public function getAuthenticatedUserFullName()
    {
        return auth()->user()->first_name. " ". auth()->user()->sur_name;
    }

    public function userCreatedDate()
    {
        $user = static::where('id', auth()->id())->first();

        $created_date = Carbon::parse($user->created_at)->toFormattedDateString();

        return $created_date;
    }

    public function authenticatedUserProfile()
    {
        $user = static::where('id', auth()->id())->first();

//        $title = new Title();
//
//        $gender = new Gender();
//
//        $role = new Role();
//
//        $data = [
//            'title' => $title->getTitleById($user->title),
//            'full_name' => $user->first_name." ".$user->last_name." ".$user->other_name,
//            'date_of_birth' => Carbon::parse($user->date_of_birth)->toFormattedDateString(),
//            'email' => $user->email,
//            'phone_number' => $user->phone_number,
//            'address' => $user->address,
//            'gender' => $gender->getGenderById($user->gender),
//            'agency_name' => $user->agency_name,
//            'agent_id' => $user->agent_id,
//            'office_number' => $user->office_number,
//            'account_status' => $this->status($user->account_status),
//            'role' => $role->role($user->id),
//            'created_on' => Carbon::parse($user->created_at)->toFormattedDateString()
//        ];
//
//        return $data;
    }

    public function getUserProfileById($id)
    {
        $user = static::where('id', $id)->first();

        $title = new Title();

        $gender = new Gender();

        $role = new Role();

        $data = [
            'title' => $title->getTitleById($user->title),
            'full_name' => $user->first_name." ".$user->last_name." ".$user->other_name,
            'date_of_birth' => Carbon::parse($user->date_of_birth)->toFormattedDateString(),
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'gender' => $gender->getGenderById($user->gender),
            'agency_name' => $user->agency_name,
            'agent_id' => $user->agent_id,
            'office_number' => $user->office_number,
            'account_status' => $this->status($user->account_status),
            'role' => $role->role($user->id),
            'created_on' => Carbon::parse($user->created_at)->toFormattedDateString()
        ];

        return $data;
    }

    public function checkPassword(array $data)
    {
        $user = static::where('email', auth()->user()->email)->first();

        if(Hash::check($data['old_password'], $user->password))
        {
            return true;
        }

        return false;
    }

    public function changePassword(array $data)
    {
        $user = static::where('id', auth()->id())->first();

        $user->password = Hash::make($data['new_password']);

        if ($user->update())
        {
            return true;
        }

        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//       'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];


    public static function store($data){
        return static::create([
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);
    }



}
