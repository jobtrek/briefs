@if ($getState())
    <div class="backdrop-hue-rotate-0">
        <div><strong>Travail d'équipe:</strong> {{ $getState()->teamwork }}%</div>
        <div><strong>Ponctualité:</strong> {{ $getState()->punctuality }}%</div>
        <div><strong>Réactivité:</strong> {{ $getState()->reactivity }}%</div>
        <div><strong>Communication:</strong> {{ $getState()->communication }}%</div>
        <div><strong>Résolution de problèmes:</strong> {{ $getState()->problem_solving }}%</div>
        <div><strong>Adaptabilité:</strong> {{ $getState()->adaptability }}%</div>
        <div><strong>Innovation:</strong> {{ $getState()->innovation }}%</div>
        <div><strong>Professionnalisme:</strong> {{ $getState()->professionalism }}%</div>
    </div>
@else
    <div class="text-red-500">Aucune évaluation disponible</div>
@endif
