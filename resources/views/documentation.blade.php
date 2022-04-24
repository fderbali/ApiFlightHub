<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trip Builder</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="https://fahmiderbali.com">Trip Builder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!--ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                    </ul-->
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Trip builder documentation</h1>
            </div>
            <div class="m-5">
                <h4>Installation :</h4>
                <p>To start running this project locally, please run the commands bellow:</p>
                <code>
                    composer update
                </code>
                <code>
                    php artisan migrate --seed
                </code>
            </div>
            <div class="m-5">
                <h4>Endpoint :</h4>
                <code>
                    https://fahmiderbali.com/api/v1/shopping
                </code>
            </div>
            <div class="m-5">
                <h4>Flight search :</h4>
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
                <h4>Filter by airline</h4>
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
                <h4>Sort results</h4>
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
                <h4>Pagination :</h4>
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
                <h4>Limit results number :</h4>
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
    </body>
</html>
