<html>
	<head>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<style>
		/* Credit to bootsnipp.com for the css for the color graph */
		.colorgraph {
		height: 5px;
		border-top: 0;
		background: #c4e17f;
		border-radius: 5px;
		background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		}
		</style>
		<script>
		$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
            }
        }
        init();
    });
});
		</script>
	</head>
	<body>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<!------ Include the above in your HEAD tag ---------->

		<div class="container">

		<div class="row">
		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<form role="form" method="post" action="exec.php">
					<h2>New User <small> CM2P NAS</small></h2>
					<hr class="colorgraph">
					<label>Login Information</label>
					<div class="row">

						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
		                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" required>
							</div>
						</div>
					</div>
					<div class="alert alert-warning" role="alert">
						Your login has to be in lowercase caracters without those special caracters : <br/> ! " # $ % & ' ( ) * + , / : ; < = > ? @ [ ] \ ^ ` { } | ~
						Ex: fristname.lastname
					</div>
					<div class="form-group">
						<input type="text" name="login" id="display_name" class="form-control input-lg" placeholder="login" tabindex="3" required>
					</div>
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="group">Project Group </label>
								<em>CTRL+click to select multiple project group</em>
								<select name="group[]" class="form-control" tabindex="7" multiple>
									<option value="Academic">Academic</option>
									<option value="Verbom">Verbom</option>
									<option value="Safran">Safran</option>
									<option value="Simulations">Simulations</option>
									<optgroup label="FinklSteel">
										<option value="FinklSteel/Casting">Finkl Steel / Casting </option>
										<option value="FinklSteel/Cracking">Finkl Steel / Cracking </option>
										<option value="FinklSteel/Forging">Finkl Steel / Forging </option>
										<option value="FinklSteel/Heat Treatments">Finkl Steel / Heat Treatments </option>
									</optgroup>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-3 col-md-3">
							<span class="button-checkbox">
								<button type="button" class="btn" data-color="info" tabindex="7" >I Agree</button>
		                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" required value="1">
							</span>
						</div>
						<div class="col-xs-8 col-sm-9 col-md-9">
							 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="../index.html#Term_and_Use" target="_blank">Terms and Use</a> set out for the NAS.
						</div>
					</div>

					<hr class="colorgraph">
					<div class="row">
						<div class="col-xs-12 col-md-12"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="8"></div>
					</div>
				</form>
			</div>
		</div>
		</div>
	</body>
</html>
