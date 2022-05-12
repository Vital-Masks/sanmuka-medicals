@if(session()->has('success'))
<span style="font-size: 12px; color: green;">{{session()->get('success')}}</span>
@endif


@if(count($errors) > 0)

        @foreach ($errors->all() as $error)
          <span style="font-size: 12px; color: rgb(255, 0, 0);">{{ $error }}</span>
        @endforeach

@endif