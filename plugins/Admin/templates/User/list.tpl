<table width="100%">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
    </tr>
    <tr v-for="user in users">
        <td>[user.full_name]</td>
        <td>[user.email]</td>
        <td>[user.phone]</td>
        <td>[user.address]</td>
    </tr>
</table>

