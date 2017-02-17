@extends('layout.standard')

@section('content')
<h1>Harvest</h1>
<p>Your new employer, Yasashii Heavy Space Boats, has dispatched you to this sector. Preliminary survey reports indicated that it was rich in Q-42, a wonderful substance that enables FTL travel.</p>
<p>Your crew just finished bringing your space station on-line, so it's time to get to the business of prospecting and expoiting. You're in charge. Make money, or the YHSB board will execute you.</p>

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Resource</th>
            <th>In Storage</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resources as $resource)
        <tr>
            <td><img src='{{ $resource->type->icon }}'></td>
            <td>{{ $resource->type->name }}</td>
            <td>{{ $resource->quantity }}</td>
            <td><input type='button' value='Harvest' disabled></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
