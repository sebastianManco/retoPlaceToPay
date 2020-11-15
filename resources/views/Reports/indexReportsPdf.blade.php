
<table class="table table-striped">
    <thead>
    <tr>
        <th>Nombre</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pdf as $pdfs)
        <tr>
            <td>
                <a href="{{asset('/public/'. $pdfs->name)}}">{{$pdfs->name}}</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
