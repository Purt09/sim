<?php
/**
 * @var \App\Models\Country $country
 */
?>
@php
    /** @var App\Models\Country $country */
@endphp
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{ $country->name }}">
</div>
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title</label>
    <input type="text" class="form-control" name="title_ru" id="title_ru" placeholder="Title RU" value="{{ $country->title_ru }}">
</div>
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title_eng</label>
    <input type="text" class="form-control" name="title_eng" id="title_eng" placeholder="Title ENG" value="{{ $country->title_eng }}">
</div>
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Image</label>
    <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="{{ $country->image }}">
</div>

<button type="submit" class="btn btn-success">Сохранить</button>
