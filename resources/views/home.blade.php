@extends('app')

@section('content')
<body>
    <div class="container">
        <div class="jumbotron" style="height:100%">
            <div class="text-center">
                <br><br>
                <img src="img/altlogo.png" class="img-rounded" alt="Welcome to Snackr" width="700">
                <br>
                <img src="img/subtext.png" class="img-rounded" alt="Welcome to Snackr" width="450">
                <br>
                <br>
                <img src="img/aubergine.png" class="img-rounded" alt="Welcome to Snackr" width="155" height="236">
                <br>
                <br><br>
            </div>
        </div>
        <div class="row text-center" style="padding-left:70px; padding-right:70px">
            <p class="faq">
              <span class="question">What is Snackr?</span><br>
              <span class="answer">Snackr is personal nutrition tracker with a smart food discovery tool.</span>
            </p>
            <p class="faq">
              <span class="question">Why should I use Snackr?</span><br>
              <span class="answer">Healthy eating can be difficult to maintain. Snackr helps with that.</span>
            </p>
            <p class="faq">
              <span class="question">Is Snackr approved by medical doctors?</span><br>
              <span class="answer">No. While we try our best to ensure that Snackr provides beneficial nutrition information to its users, Snackr is currently not reviewed or approved or endorsed by medical professionals and should not be considered a replacement for medical advice.</span>
            </p>
            <p class="faq">
              <span class="question">Where does Snackr get its data?</span><br>
              <span class="answer">All of our data comes from the USDA's National Nutrient Database. You can find it 
                <a href="http://ndb.nal.usda.gov/ndb/doc/index">here</a>.</span>
            </p>
        </div>
        <style>
        .faq > .question{
            font-size:18px;
            color: #8D1E93;
        }
        .faq > .answer{
            font-size:15px;
        }
        </style>
    </div>
</body>
    <style>
    .container{height: 100%; width: 100%;}
    </style>
@endsection

