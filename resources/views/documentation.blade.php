<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trip Builder</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            code{
                background-color: #e9ecef;
                padding: 5px;
                border-radius: 3px;
                display: block;
                margin: 5px;
                padding: 15px;
            }
            #myBtn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 18px;
                border: none;
                outline: none;
                background-color: red;
                color: white;
                cursor: pointer;
                padding: 15px;
                border-radius: 4px;
            }

            #myBtn:hover {
                background-color: #555;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="https://fahmiderbali.com">Trip Builder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#installation">Installation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#endpoint">Endpoint</a></li>
                        <li class="nav-item"><a class="nav-link" href="#flight_search">Flight search</a></li>
                        <li class="nav-item"><a class="nav-link" href="#response">Response</a></li>
                        <li class="nav-item"><a class="nav-link" href="#airline_filter">Filter by airline</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sort">Sort results</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pagination">Pagination</a></li>
                        <li class="nav-item"><a class="nav-link" href="#maxresults">Limit results</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Trip builder documentation</h1>
            </div>
            <div class="m-5">
                <h4 id="installation">Installation :</h4>
                <p>To start running this project locally, please run the commands bellow:</p>
                <code>
                    composer update
                </code>
                <code>
                    php artisan migrate --seed
                </code>
            </div>
            <div class="m-5">
                <h4 id="endpoint">Endpoint :</h4>
                <code>
                    https://fahmiderbali.com/api/v1/shopping
                </code>
            </div>
            <div class="m-5">
                <h4 id="flight_search">Flight search :</h4>
                <p>Flight builder support 4 search types : one way, return, open jaw and multicity.</p>
                <p>To make a flight search, we have to provide city pairs.</p>
                <ul>
                    <li>
                        Searching one way flight means we have to provide one city pair.
                    </li>
                    <li>
                        Searching return or open jaw flight means we have to provide two city pairs.
                    </li>
                    <li>
                        Searching multicity flight means we have to provide several city pairs. Flight builder supports up to 4 city pairs.
                        If you provide more than 4 city pairs, an error will be returned.
                    </li>
                </ul>
                <p>Here is an example of one way flight search request:</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        }
    ]
}
                    </pre>
                </code>
                <p>Here is an example of return flight search request:</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ]
}
                    </pre>
                </code>
                <p>Here is an example of open jaw flight search request:</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYC",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YVR",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ]
}
                    </pre>
                </code>
                <p>Here is an example of multi-city flight search request:</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YEG",
            "date_dep": "09-06-2022"
        },
        {
            "airport_dep": "YEG",
            "airport_arr": "YYC",
            "date_dep": "15-06-2022"
        },
        {
            "airport_dep": "YYC",
            "airport_arr": "YVR",
            "date_dep": "22-06-2022"
        }
    ]
}
                    </pre>
                </code>
                <b>POST</b> method must be use to perform a flight search.
                <img src="{{ asset('img/example_request.png') }}" alt="">
            </div>
            <div class="m-5">
                <h4 id="response">Reponse :</h4>
                <p>Response is composed by the following elements :</p>
                <ul>
                    <li>itinerary: the itinerary of the trip</li>
                    <li>trip_type: can be <b>OW</b> for one way, <b>RE</b> for return, <b>OJ</b> for open jaw or <b>MC</b> for multi-city</li>
                    <li>price: the total price of the trip</li>
                    <li>date_dep: departure date of the trip</li>
                </ul>
                <p>Here is an example of response of one way flight search :</p>
                <code>
                    <pre>
[
    {
        "itinerary": [
            {
                "airline": "UA",
                "airline_name": "United Airlines",
                "flight_number": 128,
                "departure": {
                    "airport": "YUL",
                    "time": "08:26",
                    "airport_name": "Pierre Elliott Trudeau International"
                },
                "arrival": {
                    "airport": "YYZ",
                    "time": "11:26",
                    "airport_name": "Toronto Pearson International"
                }
            }
        ],
        "trip_type": "OW",
        "price": "1044.00",
        "date_dep": "02-06-2022"
    },
    {
        "itinerary": [
            {
                "airline": "AC",
                "airline_name": "Air Canada",
                "flight_number": 156,
                "departure": {
                    "airport": "YUL",
                    "time": "04:49",
                    "airport_name": "Pierre Elliott Trudeau International"
                },
                "arrival": {
                    "airport": "YYZ",
                    "time": "09:49",
                    "airport_name": "Toronto Pearson International"
                }
            }
        ],
        "trip_type": "OW",
        "price": "1063.00",
        "date_dep": "02-06-2022"
    },
    {
        "itinerary": [
            {
                "airline": "AA",
                "airline_name": "American Airlines",
                "flight_number": 247,
                "departure": {
                    "airport": "YUL",
                    "time": "23:40",
                    "airport_name": "Pierre Elliott Trudeau International"
                },
                "arrival": {
                    "airport": "YYZ",
                    "time": "06:40",
                    "airport_name": "Toronto Pearson International"
                }
            }
        ],
        "trip_type": "OW",
        "price": "1079.00",
        "date_dep": "02-06-2022"
    }
]
                    </pre>
                </code>
            </div>
            <div class="m-5">
                <h4 id="airline_filter">Filter by airline</h4>
                <p>
                    You can filter results by airline. To do so, add a new parameter in request : <b>airlines</b><br>
                    This parameter must be an array.
                </p>
                <p>Here is an example of a request with airlines parameter :</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ],
    "airlines":["AC","WS"]
}
                    </pre>
                </code>
            </div>
            <div class="m-5">
                <h4 id="sort">Sort results</h4>
                <p>
                    You can sort results by price or by departure time. To do so, add a new parameter in request : <b>sortBy</b><br>
                    This parameter must <b>price</b> or <b>time</b>
                </p>
                <p>Here is an example of a request with sortBy parameter :</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ],
    "sortBy":"price"
}
                    </pre>
                </code>
            </div>
            <div class="m-5">
                <h4 id="pagination">Pagination :</h4>
                <p>
                    Results can be paginated. To have results paginated, add 2 new parameters in request : <b>page</b> and <b>perPage</b><br>
                </p>
                <p>
                    If page and perPage are not provided, all results will be rendered without pagination.
                </p>
                <p>Here is an example of a request with page and perPage parameter :</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ],
    "page":"1",
    "perPage":"10"
}
                    </pre>
                </code>
            </div>
            <div class="m-5">
                <h4 id="maxresults">Limit results number :</h4>
                <p>
                    Results can be limited. To do so, add a new parameters in request : <b>maxresults</b><br>
                </p>
                <p>Here is an example of a request with maxresults parameter :</p>
                <code>
                    <pre>
{
    "cityPairs":[
        {
            "airport_dep": "YUL",
            "airport_arr": "YYZ",
            "date_dep": "02-06-2022"
        },
        {
            "airport_dep": "YYZ",
            "airport_arr": "YUL",
            "date_dep": "09-06-2022"
        }
    ],
    "maxresults":"50"
}
                    </pre>
                </code>
            </div>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <script>
            //Get the button
            var mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html>
