
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
</div>



<div class="form-group">
    {{ Form::label('district_id', 'District') }}
    {{ Form::select('district_id', $districts, Request::old('district_id'),['placeholder' => 'Select one'], array('class' => 'form-control')) }}
   </div>
