@extends('layouts.app')

@section('content')

<div class="container">

        <table id="game-map">
            @for ($y = 0; $y < $height; $y++)
                <tr>
                    @for ($x = 0; $x < $width; $x++)
                        <td>
                            @if ($y == 0 && $x == 0)
                                <img src="{{ asset('storage/tilesets/top_left_corner.png') }}">
                            @elseif ($y == 0 && $x == $width - 1)
                                <img src="{{ asset('storage/tilesets/top_right_corner.png') }}">
                            @elseif ($y == $height - 1 && $x == 0)
                                <img src="{{ asset('storage/tilesets/bottom_left_corner.png') }}">
                            @elseif ($y == $height - 1 && $x == $width - 1)
                                <img src="{{ asset('storage/tilesets/bottom_right_corner.png') }}">
                            @elseif ($y == 0)
                                <img src="{{ asset('storage/tilesets/top_side.png') }}">
                            @elseif ($y == $height - 1)
                                <img src="{{ asset('storage/tilesets/bottom_side.png') }}">
                            @elseif ($x == 0)
                                <img src="{{ asset('storage/tilesets/left_side.png') }}">
                            @elseif ($x == $width - 1)
                                <img src="{{ asset('storage/tilesets/right_side.png') }}">
                            @else
                                <img src="{{ asset('storage/tilesets/filler.png') }}">
                            @endif


                            @foreach ($objects as $object)
                                @if ($object['x'] == $x && $object['y'] == $y)
                                    <img src="{{ asset($object['image']) }}" style="position: absolute; top: 0; left: 0;">
                                @endif
                            @endforeach

                            
                                <img src="{{ asset($player['image']) }}" style="position: absolute; top: 0; left: 0;">
                           
                        
                        </td>
                    @endfor
                </tr>
            @endfor
        </table>
    
</div>
<div id="player">
    <img src="{{ asset('storage/thumbnails/warrior.png') }}">
</div>

<script>
    const map = document.getElementById('game-map');
    let playerX = 0;
    let playerY = 0;

    document.addEventListener('keydown', event => {
        if (event.key === 'ArrowUp') {
            playerY--;
        } else if (event.key === 'ArrowDown') {
            playerY++;
        } else if (event.key === 'ArrowLeft') {
            playerX--;
        } else if (event.key === 'ArrowRight') {
            playerX++;
        }

        // Update the player position on the map
        const cells = map.querySelectorAll('td');
        const cellCount = cells.length;

        for (let i = 0; i < cellCount; i++) {
            cells[i].style.position = 'relative';
            cells[i].innerHTML = '';

            if (i === playerY * {{ $width }} + playerX) {
                const playerImg = document.createElement('img');
                playerImg.src = '{{ asset('storage/thumbnails/1_Warrior_1.png_Warrior_PlayerClass.png') }}';
                playerImg.style.position = 'absolute';
                cells[i].appendChild(playerImg);
            }
        }
    });
</script>

@endsection

