<table>
    <tr>
        <td>
            {{ config("company.name") }} <br>
            {{ config("company.address") }}
        </td>
        <td>
            @lang("ewc-codes.technology_identifier_number"): 1 <br>
            @lang("exports.waste_storage.table.header.technology_name"): Gépjárműbontás
        </td>
    </tr>
</table>
<br>
<div style="width: 100%;">
    <div style="width: 35%; float: left;">
        <table style="width: 100%">
            <tr>
                <td>@lang("machines.name")</td>
                <td>@lang("substances.mass")</td>
            </tr>
            <tr>
                <td>16 01 04*</td>
                <td>{{ $substances["160104"] ?? 0 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php($in1 = ($substances["160104"] ?? 0))
            <tr>
                <td>∑BE-1</td>
                <td>{{ $in1 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Csapadékvíz</td>
                <td>{{ $substances["130507"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>Bemosott iszap</td>
                <td>{{ $substances["130502"] ?? 0 }}</td>
            </tr>
            @php($in2 = ($substances["130507"] ?? 0) + ($substances["130502"] ?? 0))
            <tr>
                <td>∑BE-2</td>
                <td>{{ $in2 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Kompresszor olaj</td>
                <td>{{ ($substances["130899"] ?? 0) / 2 }}</td>
            </tr>
            <tr>
                <td>Víztartalom</td>
                <td>{{ ($substances["130899"] ?? 0) / 2 }}</td>
            </tr>
            @php($in3 = ($substances["130899"] ?? 0))
            <tr>
                <td>∑BE-3</td>
                <td>{{ $in3 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Felitató anyag</td>
                <td>{{ ($substances["150202"] ?? 0) / 3 * 1 }}</td>
            </tr>
            <tr>
                <td>Szennyeződés (felitatott)</td>
                <td>{{ ($substances["150202"] ?? 0) / 3 * 2 }}</td>
            </tr>
            @php($in4 = ($substances["150202"] ?? 0))
            <tr>
                <td>∑BE-4</td>
                <td>{{ $in4 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Bemenő anyagok csomagolása</td>
                <td>{{ ($substances["150110"] ?? 0) + ($substances["150101"] ?? 0) + ($substances["150102"] ?? 0) }}</td>
            </tr>
            <tr>
                <td>Hajtógázas palackok (töltet nélkül)</td>
                <td>{{ ($substances["150111"] ?? 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php($in5 = ($substances["150110"] ?? 0) + ($substances["150101"] ?? 0) + ($substances["150102"] ?? 0) + ($substances["150111"] ?? 0))
            <tr>
                <td>∑BE-5</td>
                <td>{{ $in5 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>∑BE-Összesen</td>
                <td>{{ $in1 + $in2 + $in3 + $in4 + $in5 }}</td>
            </tr>
        </table>
    </div>
    <div style="width: 30%; float: left;">
        <table style="width: 100%">
            <tr>
                <td>
                    <p style="text-align: center;">E kód</p>
                    <p style="text-align: center;">02 09</p>
                    <br>
                    <br>
                    <p style="text-align: center;">R4</p>
                    <br>
                    <br>
                    <p style="text-align: center;">T1</p>
                    <p style="text-align: center;">TECHNOLÓGIA</p>
                    <br>
                    <br>
                    <p style="text-align: center;">TEÁOR</p>
                    <p style="text-align: center;">3822</p>
                </td>
            </tr>
        </table>
    </div>
    <div style="width: 35%; float: left;">
        <table style="width: 100%;">
            <tr>
                <td>@lang("machines.name")</td>
                <td>@lang("substances.mass")</td>
            </tr>
            <tr>
                <td>13 02 05*</td>
                <td>{{ $substances["130205"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>13 02 06*</td>
                <td>{{ $substances["130206"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>13 07 01*</td>
                <td>{{ $substances["130701"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>13 07 02*</td>
                <td>{{ $substances["130702"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 07*</td>
                <td>{{ $substances["160107"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 10*</td>
                <td>{{ $substances["160110"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 13*</td>
                <td>{{ $substances["160113"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 14*</td>
                <td>{{ $substances["160114"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 02 13*</td>
                <td>{{ $substances["160213"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 08 07*</td>
                <td>{{ $substances["160807"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 06 01*</td>
                <td>{{ $substances["160601"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 06</td>
                <td>{{ $substances["160106"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 17 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160117"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 18 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160118"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 19 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160119"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>Anyag-R4</td>
                <td>{{ $substances["Anyag-R4"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 12 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160112"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 20 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160120"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 03 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160103"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 01 99 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160199"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>16 08 01 (16 01 06 továbbontásból)</td>
                <td>{{ $substances["160801"] ?? 0 }}</td>
            </tr>
            @php($out1 = ($substances["130205"] ?? 0)
                            + ($substances["130206"] ?? 0)
                            + ($substances["130701"] ?? 0)
                            + ($substances["130702"] ?? 0)
                            + ($substances["160107"] ?? 0)
                            + ($substances["160110"] ?? 0)
                            + ($substances["160113"] ?? 0)
                            + ($substances["160114"] ?? 0)
                            + ($substances["160213"] ?? 0)
                            + ($substances["160807"] ?? 0)
                            + ($substances["160601"] ?? 0)
                            + ($substances["160106"] ?? 0)
                            + ($substances["Anyag-R4"] ?? 0)
                            )
            <tr>
                <td>∑KI-1</td>
                <td>{{ $out1 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>13 05 02*</td>
                <td>{{ $substances["130502"] ?? 0 }}</td>
            </tr>
            <tr>
                <td>13 05 07*</td>
                <td>{{ $substances["130507"] ?? 0 }}</td>
            </tr>
            @php($out2 = ($substances["130507"] ?? 0) + ($substances["130502"] ?? 0))
            <tr>
                <td>∑KI-2</td>
                <td>{{ $out2 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>13 08 99*</td>
                <td>{{ ($substances["130899"] ?? 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php($out3 = ($substances["130899"] ?? 0))
            <tr>
                <td>∑KI-3</td>
                <td>{{ $out3 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>15 02 02*</td>
                <td>{{ ($substances["150202"] ?? 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php($out4 = ($substances["150202"] ?? 0))
            <tr>
                <td>∑KI-4</td>
                <td>{{ $out4 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>15 01 10*</td>
                <td>{{ ($substances["150110"] ?? 0) }}</td>
            </tr>
            <tr>
                <td>15 01 01</td>
                <td>{{ ($substances["150101"] ?? 0) }}</td>
            </tr>
            <tr>
                <td>15 01 02</td>
                <td>{{ ($substances["150102"] ?? 0) }}</td>
            </tr>
            <tr>
                <td>15 01 11</td>
                <td>{{ ($substances["150111"] ?? 0) }}</td>
            </tr>
            @php($out5 = ($substances["150110"] ?? 0) + ($substances["150101"] ?? 0) + ($substances["150102"] ?? 0) + ($substances["150111"] ?? 0))
            <tr>
                <td>∑KI-5</td>
                <td>{{ $out5 }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>∑KI-Összesen</td>
                <td>{{ $out1 + $out2 + $out3 + $out4 + $out5 }}</td>
            </tr>
        </table>
    </div>
</div>