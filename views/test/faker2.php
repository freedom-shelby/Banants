<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 02.09.2015
 * Time: 16:33
 */


$generator = Faker\Factory::create();
$generator->seed(1);
$documentor = new Faker\Documentor($generator);
?>
<?php foreach ($documentor->getFormatters() as $provider => $formatters): ?>

    ### `<?php echo $provider ?>`

    <?php foreach ($formatters as $formatter => $example): ?>
        <?php echo str_pad($formatter, 23) ?><?php if ($example): ?> // <?php echo $example ?> <?php endif; ?>

    <?php endforeach; ?>
<?php endforeach;