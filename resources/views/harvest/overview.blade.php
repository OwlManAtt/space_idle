@extends('layout.standard')

@section('content')
<h1>Harvest</h1>
<p>Your new employer, Yasashii Heavy Space Boats, has dispatched you to this sector. Preliminary survey reports indicated that it was rich in Q-42, a wonderful substance that enables FTL travel.</p>
<p>Your crew just finished bringing your space station on-line, so it's time to get to the business of prospecting and expoiting. You're in charge. Make money, or the YHSB board will execute you.</p>

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th colspan='2'>Resource</th>
            <th>In Storage</th>
            <th>Projected Harvest</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resources as $resource)
        <tr>
            <td><img src='{{ $resource['icon'] }}'></td>
            <td>
                <p class='lead'>{{ $resource['name'] }}</p>
                <p>{{ $resource['description'] }}</p>
            </td>
            <td>{{ $resource['quantity_stored']}}</td>
            <td>{{ $resource['projected_harvest'] }}</td>
            <td>
                <form action='/harvest/resource' method='post'>

                    {{ csrf_field() }}
                    <input type='hidden' name='resources[]' value='{{ $resource['short_code'] }}'>
                    <input type='submit' class='btn btn-primary' value='Harvest' {{ !$resource['harvestable'] ? 'disabled' : '' }}>
                </form>
                DR = {{ $resource['diminishing_return_modifier'] }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan='4'>&nbsp;</td>
            <td>
                <form action='/harvest/resource' method='post'>
                    {{ csrf_field() }}
                    <input type='hidden' name='resources'>
                    <input type='submit' class='btn btn-primary' value='Harvest All' {{ !$enable_all_btn ? 'disabled' : '' }}>
                </form>

            </td>
        </tr>
    </tbody>
</table>
@endsection
