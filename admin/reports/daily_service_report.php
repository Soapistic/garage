<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 
$datedebut = isset($_GET['datedebut']) ? $_GET['datedebut'] : date("Y-m-d"); 
$datefin = isset($_GET['datefin']) ? $_GET['datefin'] : date("Y-m-d"); 
?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Rapport des factures</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
            <fieldset class="px-2 py-1 border">
                <legend class="w-auto px-3">Filtrer</legend>
                <div class="container-fluid">
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Du</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="datedebut" id="date" value="<?= date("Y-m-d", strtotime($date)) ?>" required="required">
                                    <label for="date" class="control-label">Jusqu'au</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="datefin" id="date" value="<?= date("Y-m-d", strtotime($date)) ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm bg-gradient-primary rounded-0"><i class="fa fa-filter"></i> Filtrer</button>
                                    <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border" type="button" id="print"><i class="fa fa-print"></i> Imprimer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
		</div>
        <div class="container-fluid" id="printout">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Code</th>
						<th>Client</th>
						<th>Statut</th>
						<th>Prix</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    $total = 0;
					$i = 1;
                    $qry = $conn->query("SELECT * from `transaction_list` WHERE date_updated BETWEEN '{$datedebut}' AND '{$datefin}'");
                    while($row = $qry->fetch_assoc()):
                        $total += $row['amount'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?= date("M d, Y H:i", strtotime($row['date_created'])) ?></td>
							<td><?= $row['code'] ?></td>
							<td><?= $row['client_name'] ?></td>
							<td>
                            <?php 
								switch($row['status']){
									case 0:
										echo '<span class="badge badge-default border px-3 rounded-pill">En Attente</span>';
										break;
									case 1:
										echo '<span class="badge badge-primary px-3 rounded-pill">En cours</span>';
										break;
									case 2:
										echo '<span class="badge badge-success px-3 rounded-pill">Validé</span>';
										break;
									case 3:
										echo '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Payé</span>';
										break;
									case 4:
										echo '<span class="badge badge-danger px-3 rounded-pill">Annulé</span>';
										break;
								}
								?>
                            </td>
							<td class='text-right'><?= format_num($row['amount']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
                <tfoot>
                    <th class="py-1 text-center" colspan="5">Total</th>
                    <th class="py-1 text-right"><?= format_num($total,2) ?></th>
                </tfoot>
			</table>
		</div>
	</div>
</div>
<noscript id="print-header">
    <div>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
                <h3 class="text-center mb-0"><b>Rapport des factures</b></h3>
                <div class="text-center">du <?= date("d/m/Y", strtotime($datedebut)) ?></div>
                <h4 class="text-center mb-0"><b>au <?= date("d/m/Y", strtotime($datefin)) ?></b></h4>
            </div>
        </div>
    </div>
    <hr>
    </div>
</noscript>
<script>
	$(document).ready(function(){
		$('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=reports/daily_service_report&"+$(this).serialize()
        })
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Daily Services Report - Print View')

            start_loader()
            var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                     nw.document.querySelector('head').innerHTML = h.html()
                     nw.document.querySelector('body').innerHTML = ph.html()
                     nw.document.querySelector('body').innerHTML += p[0].outerHTML
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                             nw.close()
                             end_loader()
                         }, 300);
                     }, 300);
        })
	})
	
</script>