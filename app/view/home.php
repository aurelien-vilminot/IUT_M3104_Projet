<div class="home">
    <div>
        <p>
            Bienvenue sur FreeNote,<br><br>
            Ce réseau social a pour vocation d'être inutile... Mais bon on a pas le choix de le faire, désolé les gars :(<br><br>
            Plus sérieusement, réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.
        </p>
    </div>

    <div>
        <table>
            <tr>
                <th>Discussion</th>
                <th>État</th>
            </tr>

            <?php
            print_r($tabDisc);
            exit;
                foreach ($tabDisc as &$discussion)
                {
                    echo '<tr>';
                    for ($i = 0 ; $i < 2 ; ++$i)
                    {
                        echo '<td>' . $discussion[$i] . '</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
</div>
