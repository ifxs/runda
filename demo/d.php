<form class="form-horizontal" method="post" action="/index.php?controller=Admin&method=waterStoreAuditProc" id="waterstoreauditform">

									<div class="form-group">
										<div class="col-sm-3 col-sm-offset-4">
											<select id="audit" name="auditResult" class="form-control" onchange="to_next()">
												<option value="pass" checked>审核通过</option>
												<option value="fail">审核不通过</option>
											</select>
										</div>
									</div>

									<div id="aduitfailbox" class="form-group">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="text" name="auditDetail" class="form-control" placeholder="审核不通过原因">
										</div>
									</div>

									<div id="longitude" class="form-group">
										<label for="longitudeinput">请录入水站的地理位置(经纬度)</label>
										<div class="col-sm-3 col-sm-offset-4">
											<input id="longitudeinput" type="text" name="waterStoreLongitude" class="form-control" placeholder="水站经度">
										</div>
									</div>
									<div id="latitude" class="form-group">
										<div class="col-sm-3 col-sm-offset-4">
											<input type="text" name="waterStoreLatitude" class="form-control" placeholder="水站纬度">
										</div>
									</div>
	        <button type="submit" class="btn btn-primary">确定</button>
<input type="hidden" name="id" value="10000">
</form>