<form action="{{ $url }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file_input" placeholder="input file">
    <input type="submit" value="Submit CSV">
</form>
