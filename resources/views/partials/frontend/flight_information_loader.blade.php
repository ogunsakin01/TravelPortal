<div class="hidden coming-soon-wrapper full-screen flight_information_loader">
    <div class="coming-soon full-screen">
        <div class="centered-box text-center">
            <div class="logo">
                <h2>{{config('app.name')}}</h2>
            </div>
            <div class="loading-animation" align="center">
                <span><i class="fa fa-plane"></i></span>
                <span><i class="fa fa-bed"></i></span>
                <span><i class="fa fa-ship"></i></span>
                <span><i class="fa fa-suitcase"></i></span>
            </div>
            <div class="search-title" align="center">
                <span><i class="fa fa-smile-o "></i> Great Choice !!!</span>
                <h6>Hold on for some seconds while we get more information on your choice ... </h6>
            </div>
            <div class=" confirmation-detail">
                <h3>Booking Details</h3>
                <table class="table">
                    <tr>
                        <td>Airline</td>
                        <td class="displayAirline"></td>
                    </tr>
                    <tr>
                        <td>Cabin Type</td>
                        <td class="cabinType"></td>
                    </tr>
                    <tr>
                        <td>Stops</td>
                        <td class="stops"></td>
                    </tr>
                    <tr>
                        <td>Total Pricing</td>
                        <td class="totalPricing"></td>
                    </tr>
                </table>
            </div>
            <p class="copyright">&copy; {{date('Y')}} {{config('app.name')}}</p>
        </div>
    </div>
</div>