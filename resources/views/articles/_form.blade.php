<div class="form-group">
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
</div>
{!! Form::hidden('thumb') !!}
<div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox" name="comment_status" value="1" checked="checked"> Enable comments
    </label>
</div>

<div class="form-group">
    {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Abstract of the article, if left blank, take the first part of the content']) !!}
</div>

<div class="form-group editor">
    {!! Form::textarea('body', null, ['id' => 'myEditor', 'class' => 'form-control', 'placeholder' => 'Article content']) !!}
</div>

{{-- <div id="preview"></div> --}}

<div class="form-group">
    {{-- {!! Form::label('tags', 'Tags:') !!} --}}
    {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple', 'placeholder' => 'Label']) !!}
</div>

<div class="form-group">
    {!! Form::submit('submit', ['class' => 'btn btn-primary form-control']) !!}
</div>