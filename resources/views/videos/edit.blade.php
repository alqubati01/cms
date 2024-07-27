@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Video</h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-validate" action="{{ route('videos.update', ['video' => $video->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}" placeholder="Enter a video title..">
                                    </div>
                                    @error('title')
                                        <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="file" class="form-label">Video</label>
                                    <input class="form-control" type="file" id="video" name="video">
                                    @error('video')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="editor">Content
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="editor" name="content" rows="7" placeholder="Enter content for video">{{$video->content}}</textarea>
                                    @error('content')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter meta title for video">{{$video->meta_title}}</textarea>
                                    @error('meta_title')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="5" placeholder="Enter meta description for video">{{$video->meta_description}}</textarea>
                                    @error('meta_description')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label class="form-label" for="statues">Statuses</label>
                                    <select class="form-control default-select" id="statues" name="statues_id">
                                        @foreach($statuses as $statues)
                                            <option value="{{ $statues->id }}" @selected($statues->id == $video->statues_id)>{{ $statues->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="visibility">Visibility</label>
                                    <select class="form-control default-select" id="visibility" name="visibility">
                                        <option value="0" @selected(0 == $video->visibility)>Public</option>
                                        <option value="1" @selected(1 == $video->visibility)>Private</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Categories</label>
                                    <select class="form-control default-select" id="category" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id == $video->category_id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="featured">Featured</label>
                                    <select class="form-control default-select" id="featured" name="featured">
                                        <option value="0" @selected(0 == $video->featured)>Not Featured</option>
                                        <option value="1" @selected(1 == $video->featured)>Featured</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="tags">Tags</label>
                                    <select multiple class="form-control default-select" id="tags" name="tags[]">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @foreach($video->tags as $postTag)
                                                    {{ $tag->id == $postTag->id ? 'selected' : '' }}
                                                @endforeach
                                            >{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-20">Update Video</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Jquery Validation -->
    <script src={{ asset("vendor/jquery-validation/jquery.validate.min.js") }}></script>
    <script>
        jQuery(".form-validate").validate({
            rules: {
                "title": {
                    required: !0,
                    minlength: 5
                },
                "editor": {
                    required: !0,
                },
            },
            messages: {
                "title": {
                    required: "Please enter a title",
                    minlength: "Your title must consist of at least 5 characters"
                },
                "editor": {
                    required: "Please enter a content",
                },
            },
            ignore: [],
            errorClass: "invalid-feedback animated fadeInUp",
            errorElement: "div",
            errorPlacement: function(e, a) {
                jQuery(a).parents(".form-group > div").append(e)
            },
            highlight: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            },
            success: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            },
        });
    </script>
@endpush
