<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => 'users.search', 'method' => 'POST']) !!}
        <div class="row offset-4">
            {!! Form::text('search', null, ['placeholder' => 'Name, Email', 'class' => 'form-control col-md-3']) !!}
            {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary col-md-1']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>