@extends('layout')
@section('title', 'New Track')
@section('content')
  <head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/newtrack_styles.css') }}">

    <script defer src="{{ asset('js/events.js') }}"></script>
    <script defer src="{{ asset('js/keypress.js') }}"></script>
  </head>

  <body>
    <main>
      <!--display error messages-->
      <div class="mt-6">
          @if($errors->any()) <!--check for errors-->
              <div class="col-12">
                  @foreach($errors->all() as $error)
                      <div class="alert alert-danger">{{$error}}</div>
                  @endforeach
              </div>
          @endif

          @if(session()->has('error'))
              <div class="alert alert-danger">{{session('error')}}</div>
          @endif

          @if(session()->has('success'))
              <div class="alert alert-success">{{session('success')}}</div>
          @endif
      </div>
      <h2>Add new tracks!</h2>
      <p class="guidetext"> Here you can find new tracks to your list. d-_-b </p>
      <form action="{{route('newtrack.post')}}" method="POST" enctype="multipart/form-data"> <!--enctype="multipart/form-data" is required for uploading files-->
        @csrf
        <fieldset>
          <div class='grid inputGroup'>
            <label> *Artist: </label>
            <input list="artist-options" name="artist" id="artist" class="inputForm" required />
            <datalist id="artist-options">
              @foreach(auth()->user()->songs->pluck('artist')->unique() as $artist)
                <option value="{{$artist}}"></option>
              @endforeach
            </datalist>
            <div class="invalid-feedback">Please provide a valid name.</div>
          </div>

          <div class='grid inputGroup'>
            <label> Album: </label>
            <input type="text" name="album" id="album" class="inputForm" />
            <div class="invalid-feedback">Please provide a valid name.</div>
          </div>

          <div class='grid inputGroup'>
            <label> *Song Title: </label>
            <input type="text" name="title" id="title" class="inputForm" required />
            <div class="invalid-feedback">Please provide a valid name.</div>
          </div>

          <div class='grid inputGroup'>
            <label> Year: </label>
            <input type="number" name="year" id="year" class="inputForm" />
            <div class="invalid-feedback">Please provide a valid year.</div>
          </div>

          <div class='grid'>
            <label> Description: </label>
            <textarea name="description" id="description" class="inputForm"></textarea>
          </div>
        </fieldset>
        <fieldset>
          <div class='grid tracks inputGroup'>
            <label> Tracks (.mp3, .wav, .acc): </label>
            <div class='grid inputs'>
              <div class='track'>
                <input type="file" name="file_path_track[]" class="inputForm" multiple accept=".mp3, .wav, .acc" style="border: 0px">
                <button class="remove" type='button' disabled='disabled'><i class="fas fa-trash-alt"></i> Remove</button>
              </div>
            </div>
            <div class="invalid-feedback">Please provide at least one track.</div>
          </div>
          <div class='grid tracks inputGroup'>
          <br>
          <label> Cover Art: </label>
            <div class='grid inputs'>
              <div class='track'>
                <input type="file" name="cover_art" class="inputForm" accept=".png, .jpeg, .jpg" style="border: 0px">
                <button class="remove" type='button' disabled='disabled'><i class="fas fa-trash-alt"></i> Remove</button>
              </div>
            </div>
            <div class="invalid-feedback">Please provide at least one track.</div>
          </div>
        </fieldset>
        <button type="submit" value="Save" class="submitbutton">Save</button>
      </form>
      <p>The fields denoted with * are required to save the track.</p>
    </main>
  </body>
@endsection
