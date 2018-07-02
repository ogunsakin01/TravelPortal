<?php

namespace App\Http\Controllers;

use App\Attraction;
use App\CabinType;
use App\FlightDeal;
use App\Gallery;
use App\HotelDeal;
use App\PackageBooking;
use App\PackageCategory;
use App\SightSeeing;
use App\TravelPackage;
use Illuminate\Http\Request;
use nilsenj\Toastr\Facades\Toastr;

class TravelPackageController extends Controller
{

    public function packageCreate(){
        $package_categories = PackageCategory::all();
        $cabin_types = CabinType::all();
        return view('pages.backend.travel-packages.new_package', compact('package_categories','cabin_types'));
    }

    public function create(Request $r){

        $options = explode(',',$r->options);
        $flight = 0;
        $hotel = 0;
        $attraction = 0;
        foreach($options as $option){
            if($option === 'flight'){
                $flight = 1;
            }
            if($option === 'hotel'){
                $hotel = 1;
            }
            if($option === 'attraction'){
                $attraction = 1;
            }
        }
        $info = [
            'flight'      => $flight,
            'hotel'       => $hotel,
            'attraction' => $attraction,
            'default'     => $r
        ];
        return TravelPackage::store($info);
    }

    public function createFlightDeal(Request $r){

        return FlightDeal::store($r);
    }

    public function createHotelDeal(Request $r){

        return HotelDeal::store($r);
    }

    public function createAttraction(Request $r){

        $attraction = Attraction::store($r);
        $sight_seeing_ids = explode('---', $r->sight_seeing_ids);
        $sight_seeing_titles = explode('---', $r->sight_seeing_titles);
        $sight_seeing_descriptions = explode('---', $r->sight_seeing_descriptions);
        for($i = 0; $i < count($sight_seeing_titles); $i++){
            $sightSeeing = [
                'package_id'      => $r->package_id,
                'attraction_id'   => $attraction->id,
                'sight_seeing_id' => $sight_seeing_ids[$i],
                'title'           => htmlentities($sight_seeing_titles[$i],ENT_QUOTES,'UTF-8',false),
                'description'     => htmlentities($sight_seeing_descriptions[$i],ENT_QUOTES,'UTF-8',false)
            ];

            SightSeeing::storeSightSeeing($sightSeeing);
        }
        return $attraction;
    }

    public function createSightSeeings(Request $r){

        return SightSeeing::store($r);
    }

    public function travelPackages(){
        $packages = TravelPackage::getAllPackagesDesc();
        return view('pages.backend.travel-packages.packages', compact('packages'));
    }

    public function activate($id)
    {
        $response = [
            'status'=>''
        ];

        if (TravelPackage::isActivated($id))
        {
            $response['status'] = 'activated';
            return response()->json($response);
        }else
        {
            if (TravelPackage::activatePackage($id))
            {
                $response['status'] = true;
                return response()->json($response);
            }
            else
            {
                $response['status'] = false;
                return response()->json($response);
            }
        }
    }

    public function deactivate($id)
    {
        $response = [
            'status'=>''
        ];

        if (TravelPackage::isDeactivated($id))
        {
            $response['status'] = 'deactivated';
            return response()->json($response);
        }else
        {
            if (TravelPackage::deactivatePackage($id))
            {
                $response['status'] = true;
                return response()->json($response);
            }
            else
            {
                $response['status'] = false;
                return response()->json($response);
            }
        }
    }

    public function deletePackage($id){
        return TravelPackage::deletePackage($id);
    }

    public function editPackage($id){
        $package_categories = PackageCategory::all();
        $cabin_types = CabinType::all();
        $package    = TravelPackage::find($id);
        $flightDeal = FlightDeal::getByPackageId($id);
        $hotelDeal = HotelDeal::getByPackageId($id);
        $attraction = Attraction::getByPackageId($id);
        return view('pages.backend.travel-packages.edit_package',compact('package','flightDeal','hotelDeal','attraction','package_categories','cabin_types'));

    }

    public function deleteImage(Request $r){
        $gallery = Gallery::find($r->id);
        $deleteImage = unlink($gallery->image_path);
        $deleteRecord = $gallery->delete();
        if($deleteImage && $deleteRecord){
            return 1;
        }else{
            return 2;
        }
    }

    public function categories(){
        $package_categories = PackageCategory::orderBy('id','desc')->get();
        return view('pages.backend.travel-packages.categories',compact('package_categories'));
    }

    public function activateCategory(Request $r){
        $category = PackageCategory::find($r->id);
        if($category->status == 1){
            return 2;
        }
        $category->status = 1;
        $category->update();
        return 1;
    }

    public function deActivateCategory(Request $r){
        $category = PackageCategory::find($r->id);
        if($category->status == 0){
            return 2;
        }
        $category->status = 0;
        $category->update();
        return 1;
    }

    public function categoryCreateOrUpdate(Request $r){
        PackageCategory::store($r);
        Toastr::success('Package information updated in database');
        return redirect(url('backend/travel-packages/categories'));
    }

    public function storeGalleryImages(Request $r){
        $image = $r->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image_path = 'images/gallery/packages/'.$imageName;
        $image->move(public_path('images/gallery/packages'),$imageName);
        $gallery = new Gallery();
        $gallery->package_id = $r->package_id;
        $gallery->image_type_id = $r->image_type_id;
        $gallery->parent_id = array_get($r,'parent_id',0);
        $gallery->image_path = $image_path;
        $gallery->save();
        return response()->json(['success'=>$imageName]);
    }

    public function deleteSightSeeing($id){
        $delete = SightSeeing::find($id)->delete();
        if($delete){
            return 1;
        }
        return 0;
    }

    public function bookDeal(Request $r){

        $this->validate($r,[
            'sur_name'   => 'required|string|max:200',
            'first_name' => 'required|string|max:200',
            'other_name' => 'required|string|max:200',
            'email'      => 'required|string|email',
            'phone'      => 'required|'
        ]);

        $deal = TravelPackage::find($r->deal_id);
        $adult_amount = $deal->adult_price * $r->booking_adult_count;
        $child_amount = $deal->child_price * $r->booking_child_count;
        $infant_amount = $deal->infant_price * $r->booking_infant_count;
        $total_amount = $adult_amount + $child_amount + $infant_amount;

        $dealBooking = new PackageBooking();
        $dealBooking->user_id = auth()->id();
        $dealBooking->package_id = $r->deal_id;
        $dealBooking->reference = "PKG-".strtoupper(str_random(6));
        $dealBooking->adults = $r->booking_adult_count;
        $dealBooking->children = $r->booking_child_count;
        $dealBooking->infants = $r->booking_infant_count;
        $dealBooking->customer_title_id = $r->title_id;
        $dealBooking->customer_sur_name = $r->sur_name;
        $dealBooking->customer_first_name = $r->first_name;
        $dealBooking->customer_other_name = $r->other_name;
        $dealBooking->customer_phone = $r->phone;
        $dealBooking->customer_email = $r->email;
        $dealBooking->total_amount = ($total_amount*100);
        $dealBooking->payment_status = 0;
        $saveBooking = $dealBooking->save();
        if($saveBooking){
            session()->put('deal_booking_id',$dealBooking->id);

            return redirect(url('/deals/payment-options'));
        }

        Toastr::error('Sorry, unable to book this package','Error!!!');
        return back();

    }

    public function calculateBookingAmount(Request $r){
        $deal = TravelPackage::find($r->deal_id);
        $adult_amount = $deal->adult_price * $r->adult_count;
        $child_amount = $deal->child_price * $r->child_count;
        $infant_amount = $deal->infant_price * $r->infant_count;
        $total_amount = $adult_amount + $child_amount + $infant_amount;
        return number_format($total_amount,2);
    }

}
