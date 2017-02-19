@extends('layout.standard')

@section('content')
<h1>Research</h1>
<p>Science. It goes hand in hand with being out here in space.</p>
<p>You were never a big fan of it. Too many accidents and numbers. But, you'll get scienced up if you expect to turn a profit and avoid execution by your corporate overlords, so you've hired some scientists to do all the bits that involve maths.</p>

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th colspan='2'>Research</th>
            <th>Cost</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td>
                <p class='lead'>Martian Shit Potatoes</p>
                <p>Increases your nutrition harvesting by an additional 15% per hydroponic garden by using human fecal matter as fertilizer.</p>
            </td>
            <td>5 nutrition</td>
            <td><input type='button' class='btn btn-primary' value='Research'></td>
        </tr>
    </tbody>
</table>
@endsection
