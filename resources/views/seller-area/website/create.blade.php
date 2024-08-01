<h1>New website</h1>
<form method="post">
    @csrf
    <div>
        <label>Title</label>
        <input type="text">
    </div>
    <br>
    <div>
        <label>URL</label>
        <input type="url">
    </div>
    <br>
    <div>
        <label>Description</label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>
    <br>
    <button type="submit">Submit</button>
</form>
