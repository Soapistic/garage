<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, (coalesce((SELECT SUM(quantity) FROM `inventory_list` where product_id = product_list.id),0) - coalesce((SELECT SUM(tp.qty) FROM `transaction_products` tp inner join `transaction_list` tl on tp.transaction_id = tl.id where tp.product_id = product_list.id and tl.status != 0),0)) as `available`,coalesce((SELECT SUM(tp.qty) FROM `transaction_products` tp inner join `transaction_list` tl on tp.transaction_id = tl.id where tp.product_id = product_list.id and tl.status != 0),0) as `sold` from `product_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #cimg{
        width:15em !important;
        height:15em;
        object-fit:scale-down;
        object-position:center center
    }
</style>
<div class="container-fluid content px-4 py-5 bg-gradient-navy">
    <h3><b>Détails du stock de produit</b></h3>
</div>
<div class="row justify-content-center mt-n4">
    <div class="col-lg-10 col-md-11 col-sm-12 col-xs-12 mx-sm-1 mx-xs-1">
        <div class="card rounded-0 shadow">
            <div class="card-header">
                <div class="card-tools">
                    <button class="btn btn-primary bg-gradient-primary btn-sm rounded-0" type="button" id="create_new"><i class="fa fa-plus"></i> Ajouter un stock</button>
                    <a class="btn btn-light bg-gradient-light btn-sm rounded-0 border" href="./?page=inventory" ><i class="fa fa-angle-left"></i> Retour</a>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <fieldset>
                                <legend>Produit</legend>
                                <hr>
                                <div class="">
                                    <img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="" id="cimg" class="img-fluid bg-gradient-dark w-100">
                                </div>
                                <dl>
                                    <dt class="text-muted">Produit</dt>
                                    <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
                                    <dt class="text-muted">Description</dt>
                                    <dd class="pl-4"><?= isset($description) ? $description : '' ?></dd>
                                    <dt class="text-muted">Prix</dt>
                                    <dd class="pl-4"><?= isset($price) ? format_num($price) : '' ?></dd>
                                    <dt class="text-muted">Statut</dt>
                                    <dd class="pl-4">
                                        <?php if($status == 1): ?>
                                            <span class="badge badge-success px-3 rounded-pill">Disponible</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger px-3 rounded-pill">Indisponible</span>
                                        <?php endif; ?>
                                    </dd>
                                    <dt class="text-muted">Stock Disponible</dt>
                                    <dd class="pl-4"><?= isset($available) ? format_num($available) : '' ?></dd>
                                    <dt class="text-muted">Sold</dt>
                                    <dd class="pl-4"><?= isset($sold) ? format_num($sold) : '' ?></dd>
                                </dl>
                            </fieldset>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <fieldset>
                                <legend>Stock</legend>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-gradient-navy">
                                            <th class="px-2 py-1 text-center">Date du stock</th>
                                            <th class="px-2 py-1 text-center">Quantité</th>
                                            <th class="px-2 py-1 text-center">Fournisseur</th>
                                            <th class="px-2 py-1 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $inv_qry = $conn->query("SELECT * FROM `inventory_list` where product_id = '{$id}' order by unix_timestamp(`stock_date`) asc ");
                                        while($row = $inv_qry->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td class="px-2 py-1 align-middle"><?= date("M d, Y", strtotime($row['stock_date'])) ?></td>
                                            <td class="px-2 py-1 align-middle text-right"><?= format_num($row['quantity']) ?></td>
                                            <td class="px-2 py-1 align-middle">
                                            <?php
                                                if(isset($row['fournisseur']) && is_numeric($row['fournisseur'])){
                                                    $mechanic_id = $row['fournisseur'];
                                                    $mechanic = $conn->query("SELECT * FROM `mechanic_list` where id = '{$mechanic_id}' ");
                                                    if($mechanic->num_rows > 0){
                                                        $fournisseur = $mechanic->fetch_array()['firstname'];
                                                        echo $fournisseur;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td class="px-2 py-1 align-middle text-center">
                                                <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Modifier</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                        <?php if($inv_qry->num_rows <= 0): ?>
                                        <tr>
                                            <th class="py-1 text-center" colspan="3">Pas d'informations</th>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('<i class="far fa-plus-square"></i> Add New Stock', 'inventory/manage_stock.php?product_id=<?= isset($id) ? $id : '' ?>')
        })
        $('.edit_data').click(function(){
            uni_modal('<i class="far fa-edit-square"></i> Edit Stock', 'inventory/manage_stock.php?product_id=<?= isset($id) ? $id : '' ?>&id='+$(this).attr('data-id'))
        })
        $('.delete_data').click(function(){
			_conf("Êtes-vous certain de vouloir supprimer définitivement ces détails de stock ?","delete_inventory",[$(this).attr('data-id')])
		})
    })
    function delete_inventory($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_inventory",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
