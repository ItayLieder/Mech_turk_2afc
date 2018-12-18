<div class="h row">
    <div class="col-md-9">
        
        <!-- Main title -->
        <h1>PPCA 1611</h1>
        
        <!-- Secondary title -->
        <h2>Welcome to my auditory experiment</h2>
        
        <!-- Paragraph element -->
        <p id="warning" class="alert <?php if (isset($message) && isset($message['style'] ) ) echo $message['style']; ?>">
        	<?php if (isset($message) && isset($message['text'] ) ) echo $message['text']; ?></p>
    </div>
</div>

<div class='inputs row'>
    <div class="col-md-9">
        <!-- Form element -->
        <form action="#" method="POST" role="form">
            
            <div class="form-group">
                <label for="workerID">WorkerId:</label>
                <input type="text" name="workerID" value="<?php if (isset($workerId))echo $workerId; ?>" id = "workerID"  class="form-control">
            </div>
            
            <div class="form-group">
                <label for="age">Age*: </label>
                <input type="number" name="age" value="<?php if (isset($age))echo $age; ?>" id = "age" placeholder="In numbers 0-99 years" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="gender">Gender*: 
                female <input type="radio" name="gender" value="female" <?php if (isset($gender)&&($gender=="female")) echo "checked"; ?>> 
                male <input type="radio" name="gender" value="male" <?php if (isset($gender)&&($gender=="male")) echo "checked"; ?>> 
                </label>
            </div>
            
            <div class="form-group">
                <label for="music">Musical experience (number of training years/"none"):</label>
                <input type="text" name="music" value="<?php if (isset($music))echo $music; ?>" id = "music" class="form-control">
            </div>
            
            <input type="hidden" name="honeypot" value="">
            
            <!-- Submit button -->
            <input type="submit" name="submit" value="Submit" id="sub" class="btn btn-primary">
        </form>
    </div>
</div>