<table>
    <tr>
        <th>Utilisateurs</th>
        <th>Rôle</th>
    </tr>
    <?php
    foreach ($tabUsers as &$user)
    {
        echo '<tr>';
            if ($user[0] != $myUser->getLogin())
                echo <<<EOT
<td><a href="setUser-$user[0]">$user[0]</a></td>
EOT;
            else
                echo '<td>' . $user[0] . '</td>';
            if ($user[3] == 1)
                echo '<td><img src="media/admin.png" alt="Logo utilisateur admin" title="Administrateur"></td>';
            else
                echo '<td><img src="media/user.png" alt="Logo utilisateur" title="Utilisateur"></td>';
        echo '</tr>';
    }
    ?>
</table>
<div class="prev_next_users">
    <?php
        if ($page_users == 1)
            echo '<img src="media/prev_gray.png" alt="prev">';
        else
        {
            $page_prev = $page_users - 1;
            echo <<<EOT
<a href="users-$page_prev"><img src="media/prev.png" alt="prev"  title="Afficher les utilisateurs précédents"></a>
EOT;
        }
        if ($page_users == $nbUsersPage)
            echo '<img src="media/next_gray.png" alt="next">';
        else
        {
            $page_next = $page_users + 1;
            echo <<<EOT
<a href="users-$page_next"><img src="media/next.png" alt="next" title="Afficher les utilisateurs suivants"></a>
EOT;
        }
    ?>
</div>
