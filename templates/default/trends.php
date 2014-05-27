
<table id="trends" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Nom</th>
                <th>Expiration</th>
                <th>Synthaxe</th>
                <th>Vues</th>
                <th>Auteur</th>
            </tr>
        </thead>
 
        <tbody>
		<?php foreach($page['trends'] as $idx=>$entry) {
		$expires = ((is_null($entry['expires'])) ? " (".$lang['Never Expires'].") " : (" - ".$lang['Expires on']." " . date("D, F jS @ g:ia", strtotime($entry['expires']))));
		echo '<tr>';
			echo '<td>'.$entry['agefmt'].'</td>';
			if ( $mod_rewrite == true ) { 
				echo '<td><a href="'. $CONF['url'] . $entry['pid'] . '">' . $entry['title'] . '</a></td>'; } else { 
				echo '<td><a href="'. $CONF['url'] .'paste.php?paste='. $entry['pid'].'">' . $entry['title'] . '</a></td>'; }
			echo '<td>'.$expires.'</td>';
			echo '<td>'.$entry['format'].'</td>';
			echo '<td>'.round($entry['hits']/2).'</td>';
			echo '<td>'.$entry['agefmt'].'</td>';
		echo '</tr>';
			 } ?>

        </tbody>
    </table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#trends').dataTable( {
            "language": {
                "url": "includes/lang/<?php echo $CONF['language'] ?>_datatables.lang"
            }
        } );
    } );
</script>