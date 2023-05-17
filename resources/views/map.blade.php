@extends('layouts.app')

@section('content')

<div class="container">

        <table id="game-map">
            @for ($y = 0; $y < $height; $y++)
                <tr>
                    @for ($x = 0; $x < $width; $x++)
                        <td @if ($x === $player['x'] && $y === $player['y']) class="player" @endif>
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
                            

                            {{-- @foreach ($objects as $object)
                                @if ($object['x'] == $x && $object['y'] == $y)
                                    <img src="{{ asset($object['image']) }}" style="position: absolute; top: 0; left: 0;">
                                @endif
                            @endforeach --}}

                            @foreach ($objects as $object)
                            @if ($object['x'] == $x && $object['y'] == $y)
                                <img src="{{ $object->image->url() }}" style="
                                position: absolute; 
                                top: {{ $object['y'] }}; 
                                left: {{ $object['x'] }}; " 
                                class="mx-auto">

                                @if ($x === $player['x'] && $y === $player['y'])
                                    <!-- Perform action when player and object are on the same tile -->
                                    <script>
                                        // Example action: alert a message
                                        window.addEventListener('DOMContentLoaded', function() {
                                            alert('Player and object are on the same tile!');
                                        });
                                    </script>
                                @endif
                            @endif
                        @endforeach
                            <img src="{{ asset($player['image']) }}" style="position: absolute; top: 0; left: 0; display: none;" id="player-image">

                        </td>
                    @endfor
                </tr>
            @endfor
        </table>
        
</div>


<script>

const map = document.getElementById('game-map');
let playerX = 0;
let playerY = 0;
let playerImage = null;

document.addEventListener('keydown', event => {
    if (event.key === 'ArrowUp' && playerY > 0) {
        playerY--;
    } else if (event.key === 'ArrowDown' && playerY < {{ $height - 1 }}) {
        playerY++;
    } else if (event.key === 'ArrowLeft' && playerX > 0) {
        playerX--;
    } else if (event.key === 'ArrowRight' && playerX < {{ $width - 1 }}) {
        playerX++;
    }

    // Remove the previous player position class
    const previousCell = map.querySelector('.player');
    if (previousCell) {
        previousCell.classList.remove('player');
    }

    // Update the player position on the map
    if (playerY >= 0 && playerY < {{ $height }} && playerX >= 0 && playerX < {{ $width }}) {
        const playerIndex = playerY * {{ $width }} + playerX;
        const playerCell = map.querySelectorAll('td')[playerIndex];
        playerCell.classList.add('player');

        // Create the player image element if it doesn't exist
        if (!playerImage) {
            playerImage = document.createElement('img');
            playerImage.src = '{{ asset($player['image']) }}';
            playerImage.style.position = 'absolute';
            playerImage.style.top = '0';
            playerImage.style.left = '0';
            playerImage.style.width = '100%';
            playerImage.style.height = '100%';
        }

        // Append the player image to the current cell
        playerCell.appendChild(playerImage);

            // Check for object interaction
            const objectImages = playerCell.querySelectorAll('img');
            if (objectImages.length > 3) {
                // Perform action when player and object are on the same tile
                alert('Player and object are on the same tile!');
            }
    } else {
        // Remove the player image if the player is outside the map boundaries
        if (playerImage && playerImage.parentNode) {
            playerImage.parentNode.removeChild(playerImage);
        }
    }
    
    
});



</script>
<style></style>
@endsection

