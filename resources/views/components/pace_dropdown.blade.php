<select name="pace" id="pace" class="block mt-2">
    <option value="0.5" data-days="{{ $novel->duration(0.5, 'human') }}" {{ $subscription->pace == 0.50 ? 'selected' : ''}}>Half (about {{ $novel->duration(0.5, 'human') }})</option>
    <option value="1" data-days="{{ $novel->duration(1, 'human') }}" {{ $subscription->pace == 1.00 ? 'selected' : ''}}>Standard (about {{ $novel->duration(1, 'human') }})</option>
    <option value="2" data-days="{{ $novel->duration(2, 'human') }}" {{ $subscription->pace == 2.00 ? 'selected' : ''}}>Double (about {{ $novel->duration(2, 'human') }})</option>
    <option value="3" data-days="{{ $novel->duration(3, 'human') }}" {{ $subscription->pace == 3.00 ? 'selected' : ''}}>Triple (about {{ $novel->duration(3, 'human') }})</option>
    <option value="4" data-days="{{ $novel->duration(4, 'human') }}" {{ $subscription->pace == 4.00 ? 'selected' : ''}}>Quadruple (about {{ $novel->duration(4, 'human') }})</option>
    <option value="5" data-days="{{ $novel->duration(5, 'human') }}" {{ $subscription->pace == 5.00 ? 'selected' : ''}}>Quintuple (about {{ $novel->duration(5, 'human') }})</option>
    <option value="6" data-days="{{ $novel->duration(6, 'human') }}" {{ $subscription->pace == 6.00 ? 'selected' : ''}}>Sextuple (about {{ $novel->duration(6, 'human') }})</option>
</select>
