@extends('components.layouts.app')

@section('content')
  <main class="container grid grid-cols-1 gap-4 p-8">
    @foreach ($users as $user)
      <article class="relative flex justify-between rounded-md bg-zinc-100 px-8 py-4 shadow">
        <div>
          <div>{{ $user->name }}</div>
          <div>{{ $user->email }}</div>
        </div>

        <button popovertarget="popover-{{ $user->id }}" class="btn rounded text-blue-500">
          Ver pets
        </button>

        <div id="popover-{{ $user->id }}" popover
          class="fixed bottom-auto top-20 max-h-[70vh] w-[min(100vw-2rem,600px)] flex-col gap-4 rounded-xl bg-zinc-100 p-8 shadow backdrop:bg-black/20 open:flex"
        >
          <h2 class="pb-4 text-lg font-bold">Dados do pet</h2>

          @foreach ($user->pets as $pet)
            <div class="flex flex-col justify-between rounded border p-4">
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
