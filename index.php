<?php include('partials/header.php') ?>

<body>
<div class="container mb-3">
	<div class="col-md-12 d-flex justify-content-center text-center mb-3">
        <div class="col-md-3 col-xs-6">
            <div class="card card-body">
                <div class="flex-row">
                    <super>Uw Balans</super>
                    <br>
                    <kbd>340 HP</kbd>
                </div>
            </div>
        </div>
	</div>
    <div class="col-md-12 d-flex justify-content-center text-center mb-3">
        <button class="btn btn-rounded btn-hanze">OVERMAKEN</button>
        <button class="btn btn-rounded btn-hanze">AANVRAGEN</button>

    </div>
	<div class="row d-flex justify-content-center">
		<div class="col-md-10 col-xs-6">
			<div class="card card-body">
				<h4 class="card-title">Recente Activiteit</h4>
                <hr>
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="th-sm">#
                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                    </th>
                    <th class="th-sm">Van
                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                    </th>
                    <th class="th-sm">Naar
                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                    </th>
                    <th class="th-sm">Hoeveelheid
                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                    </th>
                    <th class="th-sm">Datum
                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                    </th>
                    <th class="th-sm">
Functies
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
<td>1</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
                </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
</body>

<?php include('partials/footer.php');