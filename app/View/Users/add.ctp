<div class="row-fluid">
    <div class="span4 columns"></div>
    <div class="span4 columns">

		        <?php
        echo $this->Form->create
                (
                'User', array
            (
            'url' => array
                (
                'controller' => 'Users',
                'action' => 'add'
            ),
            'class' => 'well form-horizontal',
            'inputDefaults' => array
                (
                'label' => true,
                'error' => false
            )
                )
        );
        ?>		
        <fieldset>
            <legend><?php echo 'Signup'; ?></legend>
            <?php
            echo $this->Form->input('username', array(
                'placeholder' => 'Username',
                'class' => 'span8',
                'label' => 'Username: ',
                'value' => !empty($user['User']['username']) ? $user['User']['username'] : ''
                    )
            );

            echo $this->Form->input('password', array(
                'type' => 'password',
                'class' => 'span8',
                'label' => 'Password: ',
                'placeholder' => 'Password'
                    )
            );

			echo $this->Form->input('email', array(
                'class' => 'span8',
                'label' => 'Email: ',
                'placeholder' => 'Email'
                    )
            );

            echo $this->Form->input('role', array(
                'options' => array('admin' => 'Admin', 'author' => 'Author'),
                'label' => 'Role: ',
                'class' => 'span8',
                'selected' => !empty($user['User']['role']) ? $user['User']['role'] : ''
            ));

            ?>
            <br/>
            <?php echo $this->Form->submit('Create Your Account', array('class' => 'btn btn-primary span10')); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    
		
</div>
    <div class="span4 columns"></div>
</div>