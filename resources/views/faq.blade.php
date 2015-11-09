@extends('app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2>FAQ</h2>
            <p class="faq">
              <span class="question">What is Snackr?</span>
              <span class="answer">Snackr is an app.</span>
            </p>
            <p class="faq">
              <span class="question">Why should I use Snackr?</span> 
              <span class="answer">Because I said so.</span>
            </p>
            <p class="faq">
              <span class="question">Is Snackr approved by medical doctors?</span>
              <span class="answer">No. While we try our best to ensure that Snackr provides beneficial nutrition information to its users, Snackr is currently not reviewed or approved or endorsed by medical professionals and should not be considered a replacement for medical advice.</span>
            </p>
            <p class="faq">
              <span class="question">Where does Snackr get its data?</span>
              <span class="answer">All of our data comes from the USDA's National Nutrient Database. You can find it 
                <a href="http://ndb.nal.usda.gov/ndb/doc/index">here</a>.</span>
            </p>
        </div>
    </div>
@endsection
