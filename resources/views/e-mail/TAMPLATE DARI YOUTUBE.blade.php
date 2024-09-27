<style>
    <blade import|%20url(%26%2334%3Bhttps%3A%2F%2Ffonts.googleapis.com%2Fcss%3Ffamily%3DLato%3A400%2C400i%2C700%26%2334%3B)%3B%0D>body {
        background-color: #6d695c;
        background-image:
            url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAACVBMVEUAAAAAAAAAAACDY+nAAAAAA3RSTlMmDQBzGIDBAAAAG0lEQVR42uXIIQEAAADCMHj/0NdkQMws0HEeAqvwAUGJthrXAAAAAElFTkSuQmCC);
        font-size: 100%;
        color: #333;
        font-family: Lato, Arial, sans-serif;
        padding: 0;
        margin: 0;
    }

    main {
        display: block;
        box-sizing: border-box;
        width: auto;
        padding: 1em 2vw;
        margin: 1em 2vw;
        color: #000;
        background-color: rgba(204, 204, 204, 0.7);
        border: 0.07em solid rgba(0, 0, 0, 0.5);
        border-radius: 0.5em;
    }

    table {
        margin: 1em 0;
        border-collapse: collapse;
        /* width: 100%; */
    }

    caption {
        text-align: left;
        font-style: italic;
        padding: 0.25em 0.5em 0.5em 0.5em;
    }

    th,
    td {
        padding: 0.25em 0.5em 0.25em 1em;
        vertical-align: text-top;
        text-align: left;
        text-indent: -0.5em;
    }

    th {
        vertical-align: bottom;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-weight: bold;
    }

    td::before {
        display: none;
    }

    tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.25);
    }

    tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.5);
    }

    td:nth-of-type(2) {
        font-style: italic;
    }

    th:nth-of-type(3),
    td:nth-of-type(3) {
        text-align: right;
    }

    div {
        overflow: auto;
    }

    <blade media|%20screen%20and%20(max-width%3A%2037em)%2C%0D>print and (max-width: 5in) {

        table,
        tr,
        td {
            display: block;
        }

        tr {
            padding: 0.7em 2vw;
        }

        th,
        tr:first-of-type {
            display: none;
        }

        td::before {
            display: inline;
            font-weight: bold;
        }

        td {
            display: grid;
            grid-template-columns: 4em auto;
            grid-gap: 1em 0.5em;
        }

        caption {
            font-style: normal;
            background-color: rgba(0, 0, 0, 0.35);
            color: #fff;
            font-weight: bold;
        }

        td:nth-of-type(3) {
            text-align: left;
        }

        td:nth-of-type(4),
        td:nth-of-type(5) {
            text-align: right;
            width: 12em;
        }

        td:nth-of-type(4)::before,
        td:nth-of-type(5)::before {
            text-align: left;
        }

        td:nth-of-type(2)::before {
            font-style: normal;
        }
    }

    <blade media|%20print%20%7B%0D>body {
        font-size: 6pt;
        color: #0044ff;
        background-color: #fff;
        background-image: none;
    }

    body,
    main {
        margin: 0;
        padding: 0;
        background-color: #fff;
        border: none;
    }

    table {
        page-break-inside: avoid;
    }

    div {
        overflow: visible;
    }

    th {
        color: #006eff;
        background-color: #fff;
        border-bottom: 1pt solid #000;
    }

    tr {
        border-top: 1pt solid #000;
    }
    }

    <blade media|%20print%20and%20(max-width%3A%205in)%20%7B%0D>caption {
        color: #000;
        background-color: #fff;
        border-bottom: 1pt solid #000;
    }

    table {
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
    }
    }

    img.kanan {
        float: right;
        margin: 5px;
    }

    img.kiri {
        float: left;
        margin: 5px;
    }

    img.tengah {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

</style>

<main>
    <td valign="top" class="bg_white" style="margin: auto;">
        <img src="{{ asset('admin/assets/img/baru1.png') }}" alt="">
        <img class="kiri" src="{{ asset('admin/assets/img/baru2.png') }}" hidden
            ari\a-colspan="" />

        {{-- <img class="kanan" src="{{ asset('admin/assets/img/baru3.png') }}"
        /> --}}
        {{-- <img class="kanan" class="kiri" src="{{ asset('admin/assets/img/baru4.png') }}"
        /> --}}
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="logo" style="text-align: center;">
                    {{-- <h1></h1> --}}

                </td>
            </tr>
        </table>
    </td>
    <div class="text" style="padding: 0 2.5em; text-align: center;">
        <h2>HR NOTIFICATION OF EMPLOYEE RETIREMENT PERIOD PT DAK</h2>
        <div role="region" aria-labelledby="Cap1" tabindex="0">
            <table id="Books">
                <caption id="Cap1">DAK EMPLOYEE RETIREMENT DAK</caption>
                <thead>
                    <tr>
                        <th width="30" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            NO
                        </th>
                        <th width="95" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            NIK</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            FULL NAME</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            POSITION</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            DATE OF BIRTH </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            CAKAR </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            12 MONTHS RETIREMENT </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            6 MONTHS RETIREMENT </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            MAX RETIREMENT 56 YEARS</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach($karyawans as $k)
                        <tr>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $no++ }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $k->nik }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $k->name }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $k->jabatan }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $k->tgl_lahir }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $k->cakar }}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{-- @if ($k->pilihan_pensiun == 12) --}}
                                    {{ date('Y-m-d', strtotime($k->tgl_lahir . ' +54years +12months')) }}
                                    {{-- @endif --}}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{-- @if ($k->pilihan_pensiun == 6) --}}
                                    {{ date('Y-m-d', strtotime($k->tgl_lahir . ' +55years +6months')) }}
                                    {{-- @endif --}}
                                </p>
                            </td>
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ date('Y-m-d', strtotime($k->tgl_lahir . ' +56years')) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
            style="margin: auto;">
            <tr>
                <td valign="middle" class="bg_light footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-right: 10px;">
                                            <h3 class="heading">About</h3>
                                            <p>PT DOK DAN PERKAPALAN AIR KANTUNG BERGERAK DI BIDANG PERBAIKAN KAPAL
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                            <h3 class="heading">Contact Info</h3>
                                            <ul>
                                                <li><span class="text">Email: info@pt-dak.co.id
                                                        Bangka Belitung, IND</span></li>
                                                <li><span class="text"> Telepon: 0717-433130</span></a></li>
                                            </ul>


                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 10px;">
                                            <h3 class="heading">Useful Links</h3>
                                            <ul>
                                                <li><a href="https://pt-dak.co.id/">Home</a></li>
                                                <li><a href="https://pt-dak.co.id/">About</a></li>
                                                <li><a href="https://pt-dak.co.id/">Services</a></li>
                                                <li><a href="https://pt-dak.co.id/">Work</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end: tr -->
            <tr>
                <td class="bg_light" style="text-align: center;">
                    <p>PT DOK DAN PERKAPALAN AIR KANTUNG <a href="#" style="color: rgba(0,0,0,.8);">IT
                            Support</a></p>
                </td>
            </tr>
        </table>
</main>
<script>
    function ResponsiveCellHeaders(elmID) {
        try {
            var THarray = [];
            var table = document.getElementById(elmID);
            var ths = table.getElementsByTagName("th");
            for (var i = 0; i < ths.length; i++) {
                var headingText = ths[i].innerHTML;
                THarray.push(headingText);
            }
            var styleElm = document.createElement("style"),
                styleSheet;
            document.head.appendChild(styleElm);
            styleSheet = styleElm.sheet;
            for (var i = 0; i < THarray.length; i++) {
                styleSheet.insertRule(
                    "#" +
                    elmID +
                    " td:nth-child(" +
                    (i + 1) +
                    ')::before {content:"' +
                    THarray[i] +
                    ': ";}',
                    styleSheet.cssRules.length
                );
            }
        } catch (e) {
            console.log("ResponsiveCellHeaders(): " + e);
        }
    }
    ResponsiveCellHeaders("Books");

    // https://adrianroselli.com/2018/02/tables-css-display-properties-and-aria.html
    // https://adrianroselli.com/2018/05/functions-to-add-aria-to-tables-and-lists.html
    function AddTableARIA() {
        try {
            var allTables = document.querySelectorAll('table');
            for (var i = 0; i < allTables.length; i++) {
                allTables[i].setAttribute('role', 'table');
            }
            var allRowGroups = document.querySelectorAll('thead, tbody, tfoot');
            for (var i = 0; i < allRowGroups.length; i++) {
                allRowGroups[i].setAttribute('role', 'rowgroup');
            }
            var allRows = document.querySelectorAll('tr');
            for (var i = 0; i < allRows.length; i++) {
                allRows[i].setAttribute('role', 'row');
            }
            var allCells = document.querySelectorAll('td');
            for (var i = 0; i < allCells.length; i++) {
                allCells[i].setAttribute('role', 'cell');
            }
            var allHeaders = document.querySelectorAll('th');
            for (var i = 0; i < allHeaders.length; i++) {
                allHeaders[i].setAttribute('role', 'columnheader');
            }
            // this accounts for scoped row headers
            var allRowHeaders = document.querySelectorAll('th[scope=row]');
            for (var i = 0; i < allRowHeaders.length; i++) {
                allRowHeaders[i].setAttribute('role', 'rowheader');
            }
            // caption role not needed as it is not a real role and
            // browsers do not dump their own role with display block
        } catch (e) {
            console.log("AddTableARIA(): " + e);
        }
    }

    AddTableARIA();

</script>
