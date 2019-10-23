<h3>Image upload</h3>
<form name="frm" action="{{route('ImageUpload')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="img[]" multiple>
    <br><br>
    <input type="submit" name="ok" value="Upload">
</form>
@if(Session::has('msg'))
{{ Session::get('msg') }}
@endif
