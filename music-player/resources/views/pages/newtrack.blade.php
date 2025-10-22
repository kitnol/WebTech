<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/newtrack_styles.css') }}">

  <script defer src="{{ asset('js/events.js') }}"></script>
  <script defer src="{{ asset('js/keypress.js') }}"></script>
  <title>New track</title>
</head>

<body>
  <!--Header-->
  <header class="header">
    <h1>d-_-b Music Player</h1>
    <nav class="navbar">
      <a href="{{ route('pages.index') }}">Home</a>
      <a href="{{ route('pages.tracks') }}">Tracks</a>
      <a href="{{ route('pages.artists') }}">Artists</a>
      <a href="{{ route('pages.newtrack') }}">Add new</a>
      <a href="{{ route('pages.profile') }}">Profile</a>
      <a href="{{ route('pages.login') }}">Login</a>
    </nav>
  </header> <!--Header-->
  <main>
    <h2>Add new tracks!</h2>
    <form>
      <fieldset>
        <div class='grid inputGroup'>
          <label> *Artist: </label>
          <input type="text" name="name" id="name" class="inputForm" required />
          <div class="invalid-feedback">Please provide a valid name.</div>
        </div>

        <div class='grid inputGroup'>
          <label> Album: </label>
          <input type="text" name="title" id="title" class="inputForm" required />
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
          <label> *Tracks (.mp3, .wav, .acc): </label>
          <div class='grid inputs'>
            <div class='track'>
              <input type="file" name="track1" class="inputForm" required accept=".mp3, .wav, .acc">
              <button class="remove" type='button' disabled='disabled'><i class="fas fa-trash-alt"></i> Remove</button>
            </div>
          </div>
          <button type='button' class="add">Add</button>
          <div class="invalid-feedback">Please provide at least one track.</div>
        </div>
        <div class='grid tracks inputGroup'>
          <label> Music sheet: </label>
          <div class='grid inputs'>
            <div class='track'>
              <input type="file" name="musicsheet1" class="inputForm" accept=".doc, .docx, .pdf, .png, .jpg, .jpeg">
              <button class="remove" type='button' disabled='disabled'><i class="fas fa-trash-alt"></i> Remove</button>
            </div>
          </div>
          <button type='button' class="add">Add</button>
          <div class="invalid-feedback">Please provide at least one track.</div>
        </div>
      </fieldset>
      <input type="submit" value="Save" class="submitbutton">
    </form>
    <p>The fields denoted with * are required to save the track.</p>
  </main>
  <footer class="bottominfo">
    © 2025 d-_-b Music Player | <a
    href="https://odin.sdu.dk/sitecore/index.php?a=fagbesk&id=157925&listid=21432&lang=en">SDU - Web
    Technologies</a> | <a href="{{ route('pages.aboutus') }}">About us</a>
  </footer>
</body>

</html>