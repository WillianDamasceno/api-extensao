@extends('components.layouts.app')

@section('content')
  <main class="container grid grid-cols-1 gap-4 p-8">
    @foreach ($users as $user)
      <article class="relative flex justify-between rounded-md bg-base-200/50 px-8 py-4 shadow">
        <div>
          <div>{{ $user->name }}</div>
          <div>{{ $user->email }}</div>
        </div>

        <button popovertarget="popover-{{ $user->id }}" class="hover:text-primary">Ver pets</button>
        <div id="popover-{{ $user->id }}" popover
          class="w-[min(100vw-2rem,600px)] rounded-xl bg-base-200/50 p-12 shadow"
        >
          @foreach ($user->pets as $pet)
            <div class="flex flex-col justify-between">
              <h2 class="text-lg font-bold">Dados do pet</h2>
              <div>Nome: {{ $pet->name }}</div>
              <div>Nascimento: {{ $pet->born }}</div>
              <div>Tipo: {{ $pet->type }}</div>

              @if (!empty($pet->vaccines) && $pet->vaccines !== '_' && $pet->vaccines)
                @php
                  $vaccines = explode(',', $pet->vaccines);
                @endphp
                @if (count($vaccines) > 1)
                  <h2 class="mt-8 text-lg font-bold">Vacinas</h2>
                  <div>
                    @foreach ($vaccines as $vaccine)
                      @php
                        $explored = explode('-', $vaccine);
                      @endphp

                      @if (count($explored) > 1)
                        @php
                          [$name, $date] = $explored;
                        @endphp
                        <div class="flex items-center">
                          <div class="mr-2">{{ $name }}</div>
                          <div>{{ $date }}</div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                @endif
              @endif
            </div>
          @endforeach
        </div>
      </article>
    @endforeach
  </main>
@endsection
