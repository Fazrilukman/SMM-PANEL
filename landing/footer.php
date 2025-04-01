<footer class="footer bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p class="copyright">&copy; 2017 <?php echo $config['web']['short_title'] ?></p>
					</div>
				</div>
			</div>
		</footer>
		
		<script src="<?php echo $config['web']['base_url'] ?>landing/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['base_url'] ?>landing/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['base_url'] ?>landing/assets/js/jquery.easing.min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['base_url'] ?>landing/assets/js/typed.js" type="text/javascript"></script>
		<!--<script src="https://medanpedia.co.id/assets/landing/typed.js" type="5a6b66c97383bb9c48146b69-text/javascript"></script>-->
		<script type="text/javascript">
            /* ==============================================
            //Typed
            =============================================== */
            $(".typed").each(function(){
                var $this = $(this);
                $this.typed({
                strings: $this.attr('data-elements').split(','),
                typeSpeed: 100, // typing speed
                backDelay: 3000 // pause before backspacing
                });
            });
        </script>
</html>