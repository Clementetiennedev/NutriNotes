@extends('layouts.app')

@section('title', 'Modifier Stat - NutriNotes')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-3xl">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <div class="flex items-center space-x-2" style="color: #ffffff;">
                    <a href="{{ route('dashboard') }}" class="transition duration-200" 
                       style="color: #ffffff;"
                       onmouseover="this.style.color='#bf0000'" 
                       onmouseout="this.style.color='#ffffff'">Dashboard</a>
                    <span>/</span>
                    <span style="color: #bf0000;">Modifier statistique</span>
                </div>
            </nav>

            <!-- Titre -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold" style="color: #ffffff;">Modifier la statistique</h2>
                <p class="mt-2" style="color: #ffffff;">Modifiez les données du {{ $stat->date->format('d/m/Y') }}.</p>
            </div>

            <!-- Formulaire -->
            <div class="rounded-lg shadow-lg border-2" style="background-color: #3b3b3b; border-color: #bf0000;">
                <form method="POST" action="{{ route('stats.update', $stat) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Date -->
                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium mb-2" style="color: #ffffff;">
                            Date <span style="color: #bf0000;">*</span>
                        </label>
                        <input type="date" 
                               name="date" 
                               id="date" 
                               value="{{ old('date', $stat->date->format('Y-m-d')) }}" 
                               required
                               class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2"
                               style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">
                        @error('date')
                            <p class="text-sm mt-1" style="color: #bf0000;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poids -->
                    <div class="mb-6">
                        <label for="weight" class="block text-sm font-medium mb-2" style="color: #ffffff;">
                            Poids (kg) <span style="color: #bf0000;">*</span>
                        </label>
                        <input type="number" 
                               name="weight" 
                               id="weight" 
                               step="0.1" 
                               min="0" 
                               max="999.99"
                               value="{{ old('weight', $stat->weight) }}"
                               placeholder="Ex: 70.5"
                               required
                               class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2"
                               style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">
                        @error('weight')
                            <p class="text-sm mt-1" style="color: #bf0000;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Calories -->
                    <div class="mb-6">
                        <label for="calories" class="block text-sm font-medium mb-2" style="color: #ffffff;">
                            Calories consommées <span style="color: #bf0000;">*</span>
                        </label>
                        <input type="number" 
                               name="calories" 
                               id="calories" 
                               min="0" 
                               max="9999"
                               value="{{ old('calories', $stat->calories) }}"
                               placeholder="Ex: 2000"
                               required
                               class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2"
                               style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">
                        @error('calories')
                            <p class="text-sm mt-1" style="color: #bf0000;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre de pas -->
                    <div class="mb-6">
                        <label for="steps" class="block text-sm font-medium mb-2" style="color: #ffffff;">
                            Nombre de pas
                        </label>
                        <input type="number" 
                               name="steps" 
                               id="steps" 
                               min="0" 
                               max="999999"
                               value="{{ old('steps', $stat->steps) }}"
                               placeholder="Ex: 8000"
                               class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2"
                               style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">
                        @error('steps')
                            <p class="text-sm mt-1" style="color: #bf0000;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-8">
                        <label for="notes" class="block text-sm font-medium mb-2" style="color: #ffffff;">
                            Notes
                        </label>
                        <textarea name="notes" 
                                  id="notes" 
                                  rows="4"
                                  maxlength="1000"
                                  placeholder="Ajoutez vos notes sur votre journée, votre humeur, vos repas..."
                                  class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 resize-none"
                                  style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">{{ old('notes', $stat->notes) }}</textarea>
                        @error('notes')
                            <p class="text-sm mt-1" style="color: #bf0000;">{{ $message }}</p>
                        @enderror
                        <p class="text-sm mt-1" style="color: #ffffff;">
                            <span id="noteCount">{{ strlen($stat->notes ?? '') }}</span>/1000 caractères
                        </p>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" 
                           class="px-6 py-2 rounded border-2 transition duration-200" 
                           style="background-color: #3b3b3b; color: #ffffff; border-color: #bf0000;"
                           onmouseover="this.style.backgroundColor='#bf0000'" 
                           onmouseout="this.style.backgroundColor='#3b3b3b'">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 rounded border-2 transition duration-200" 
                                style="background-color: #4facfe; color: #ffffff; border-color: #4facfe;"
                                onmouseover="this.style.backgroundColor='#00f2fe'" 
                                onmouseout="this.style.backgroundColor='#4facfe'">
                            💾 Modifier la statistique
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info aide -->
            <div class="mt-6 rounded-lg border-2 p-4" style="background-color: #3b3b3b; border-color: #bf0000;">
                <h3 class="font-medium mb-2" style="color: #ffffff;">💡 Information</h3>
                <p class="text-sm" style="color: #ffffff;">
                    Les champs marqués d'un <span style="color: #bf0000;">*</span> sont obligatoires. Le nombre de pas et les notes sont facultatifs.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Compteur de caractères pour les notes
        document.getElementById('notes').addEventListener('input', function() {
            const count = this.value.length;
            document.getElementById('noteCount').textContent = count;
            
            if (count > 900) {
                document.getElementById('noteCount').style.color = '#bf0000';
            } else {
                document.getElementById('noteCount').style.color = '#ffffff';
            }
        });
    </script>
@endsection