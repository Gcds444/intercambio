<table width=100% class="table table-bordered">
  <thead>
    <tr align="center">
      <th scope="col">Optativas Livres</th>
      <th scope="col">Optativas Eletivas</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="center">{{ $pedido->disciplinas->where('tipo', 'LIKE', 'Optativa Livre')->sum('conversao') }}</td>
      <td align="center">{{ $pedido->disciplinas->where('tipo', 'LIKE', 'Optativa Eletiva')->sum('conversao') }}</td>
      <td align="center">{{ $pedido->disciplinas->sum('conversao') }}</td>
    </tr>
  </tbody>
</table>