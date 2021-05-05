
<details>

    <summary>Detalles</summary>

    <ul>
        <li>
            Cantidad :{{ $detail['count'] }}
        </li>
        <li>
            Precio máximo :{{ $detail['max_price'] }}
        </li>
        <li>
            Precio mínimo :{{ $detail['min_price'] }}
        </li>
        <li>
            Promedio :{{ round($detail['avg_price'],2) }}
        </li>
        <li>
            Total :{{ $detail['total'] }}
        </li>
    </ul>

</details>
