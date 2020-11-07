					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Información</h4>
						</div>
						<div class="modal-body">
							<p>Some text in the modal.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<footer id="footer"  class="elem elem-orange">
                <?php
					$this->load->view($footer)
				?>
			</footer>
		</div>
	</div>
	<?php
		//$this->assets->load_js();

		//if (isset($script)) {
		//	echo "\n";
		//	foreach ($script as $src) {
		//		if (!preg_match('/\<script.*/', $src)) {
		//			echo '<script type="text/javascript" src="'. $src . '"></script>';
		//			echo "\n";
		//		} else {
		//			echo "\n";
		//			echo $src;
		//		}
		//	}
		//}

	    //$jsCache = (isset($limpiaCache) && $limpiaCache == TRUE) ? TRUE : FALSE;
		//cargarJS($jsCache);
	?>
</body>
</html>