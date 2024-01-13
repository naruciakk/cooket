<div style="text-align:center;"><h3>Akredytacja:</h3></div>
<table width="100%" style="text-align: center; border: 1px solid black; font-size: 10pt">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('org.codeS') }}</th>
            <th>{{ trans('auth.given_name') }}</th>
            <th>{{ trans('auth.family_name') }}</th>
            <th>{{ trans('org.nick') }}</th>
            <th>{{ trans('auth.city') }}</th>
            <th>{{ trans('org.info') }}</th>
            <th>{{ trans('org.signature') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $in = 0;
        @endphp

        @foreach($guests as $guest)
            @foreach($datas as $data)
                @if($data->guest == $guest->id)
                    <tr>
                        <td>{{ ++$in }}</td>
                        <td>{{ $guest->code }}</td>
                        <td>{{ $data->given_name }}</td>
                        <td>{{ $data->family_name }}</td>
                            @if($data->nickname == '')
                            <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                                                @else
                            <td>{{ substr($data->nickname, 0, 40) }}</td>
                                                @endif
                            <td>{{ $data->city }}</td>
                            <td>
                                @if($guest->adult)
                                    @if($guest->accomodation)
                                        <span style="color: green">T</span>&nbsp;/&nbsp;<span style="color: green">T</span>
                                    @else
                                        <span style="color: green">T</span>&nbsp;/&nbsp;<span style="color: red">N</span>
                                    @endif
                                @else
                                    @if($guest->accomodation)
                                        <span style="color: red">N</span>&nbsp;/&nbsp;<span style="color: green">T</span>
                                    @else
                                        <span style="color: red">N</span>&nbsp;/&nbsp;<span style="color: red">N</span>
                                    @endif
                                @endif

                            </td>
                            <td>………………</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
<!--
window.print();
//-->
</script>