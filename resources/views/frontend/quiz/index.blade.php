@extends('frontend.layouts.front-app')
@section('title')
<title>Quiz</title>
<meta name="DC.Title" content="Login">
@endsection

@section('content')
<style type="text/css">
    label.radio {
  cursor: pointer;
}

label.radio input {
  position: absolute;
  top: 0; 
  left: 0;
  visibility: hidden;
  pointer-events: none;
}

label.radio span {
  padding: 4px 0px;
  border: 1px solid red;
  display: inline-block;
  color: red;
  width: 100px;
  text-align: center;
  border-radius: 3px;
  margin-top: 7px;
  text-transform: uppercase;
}

label.radio input:checked + span {
  border-color: red;
  background-color: red;
  color: #fff;
}

.ans {
  margin-left: 36px !important;
}

.btn:focus {
  outline: 0 !important;
  box-shadow: none !important;
}

.btn:active {
  outline: 0 !important;
  box-shadow: none !important;
}
</style>
<div class="container-fluid mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border">
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4>MCQ Quiz</h4><span>(5 of 20)</span></div>
                    </div>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <h3 class="text-danger">Q.</h3>
                            <h5 class="mt-1 ml-2">Which of the following country has largest population?</h5>
                        </div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="brazil" value="brazil"> <span>Brazil</span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="Germany" value="Germany"> <span>Germany</span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="Indonesia" value="Indonesia"> <span>Indonesia</span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="Russia" value="Russia"> <span>Russia</span>
</label>    
</div></div>
                    <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white"><button class="btn btn-primary d-flex align-items-center btn-danger" type="button"><i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button><button class="btn btn-primary border-success align-items-center btn-success" type="button">Next<i class="fa fa-angle-right ml-2"></i></button></div>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="jumbotron col-md-8">
            <form method="POST" action="{{ url('submitquiz') }}" >
                 {{ csrf_field() }}
                <h1 id="register">Please Fill this Form</h1>
                @foreach($data as $r)
                <div class="tab">
                    <h6>{{ $r->name }}</h6>
                


                    @if($r->type == 'text')
                    <input class="form-control" @if($r->isrequired == 'yes') required @endif placeholder="{{ $r->name }}" oninput="this.className = ''" name="{{ $r->id }}">
                    @endif

                    @if($r->type == 'radio')
                    @foreach(DB::table('quizefields')->where('quiz_parent' , $r->id)->get() as $c)
                    <input type="radio" @if($r->isrequired == 'yes') required @endif name="{{ $r->id }}" oninput="this.className = ''" 
                    value="{{ $c->name }}" > {{ $c->name }}
                    @endforeach
                    @endif
                    @if($r->type == 'checkbox')
                    @foreach(DB::table('quizefields')->where('quiz_parent' , $r->id)->get() as $c)
                    <input type="checkbox" @if($r->isrequired == 'yes') required @endif name="{{ $r->id }}" oninput="this.className = ''" 
                    value="{{ $c->name }}" > {{ $c->name }}
                    @endforeach
                    @endif
                     @if($r->type == 'textarea')
                     <textarea @if($r->isrequired == 'yes') required @endif placeholder="{{ $r->name }}" class="form-control" name=""></textarea>
                    @endif
                    
                </div>
                @endforeach
                <br>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> 
                        <button class="btn btn-primary" type="submit">Submit</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection