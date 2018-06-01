<div class="hidden coming-soon-wrapper full-screen flight_search_loader">
    <div class="coming-soon full-screen">
        <div class="centered-box text-center">
            <div class="logo">
                <h2>{{config('app.name')}}</h2>
            </div>
            <div class="loading-animation" align="center">
                <span><i class="fa fa-plane"></i></span>
                <span><i class="fa fa-clock-o"></i></span>
                <span><i class="fa fa-plane"></i></span>
                <span><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="search-title" align="center">
                <p><small>We are finding the cheapest available flights for you. Hold on for some seconds </small> <br/>
                    <span class="search_departure_city"></span>&nbsp; <br/> to &nbsp;<br/><span class="search_destination_city"></span></p>
            </div>
            <div class="search-box">
                <table class="table">
                    <tr>
                        <td>Departure Date</td>
                        <td><span class="search_departure_date"></span></td>
                    </tr>
                    <tr>
                        <td>Return Date</td>
                        <td><span class="search_return_date"></span></td>
                    </tr>
                    <tr>
                        <td>Adults</td>
                        <td><span class="search_num_of_adult"></span></td>
                    </tr>
                    <tr>
                        <td>Children</td>
                        <td><span class="search_num_of_child"></span></td>
                    </tr>
                    <tr>
                        <td>Infants</td>
                        <td><span class="search_num_of_infant"></span></td>
                    </tr>
                    <tr>
                        <td>Cabin</td>
                        <td><span class="search_cabin">All Cabin</span></td>
                    </tr>
                </table>
            </div>
            <p class="copyright">&copy; {{date('Y')}} {{config('app.name')}}</p>
        </div>
    </div>
</div>