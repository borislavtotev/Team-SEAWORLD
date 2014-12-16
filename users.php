<?php
include_once( 'views/partials/header.php' );
include_once( 'system/models/user.php' );
?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron animated fadeIn">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Total Albums</th>
                    <th>Total Pictures</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach( User::getAllUsers() as $user ): ?>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td>
                        <a href="./profile.php?id=<?=$user->getId()?>">
                            <?= htmlspecialchars( $user->getUserName() ) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars( $user->getEmail() ) ?></td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<?php include_once( 'views/partials/footer.php' ); ?>