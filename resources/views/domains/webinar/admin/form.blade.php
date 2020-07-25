<div class="form-group">
    <label>Nazwa</label>
    <input type="text" name="name" required
           class="form-control"
           value="{{ old('name') ?? $webinar->name ?? '' }}">
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Opis</label>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea name="description"
              class="form-control"
              required
              style="height: 300px;"
    >{{ old('description') ?? $webinar->description ?? '' }}</textarea>

</div>
<div class="form-group">
    <label>Link do vimeo</label>
    <input type="text" name="video" required
           class="form-control"
           value="{{ old('video') ?? $webinar->video ?? '' }}"
           placeholder="https://player.vimeo.com/video/1234"
    >
    @error('video')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Data i godzina emisji</label>
    <input type="datetime-local" name="scheduled_at" required
           class="form-control"
           value="{{ old('scheduled_at') ?? (isset($webinar) ? $webinar->scheduled_at->toDateTimeLocalString() : '' ) }}"
    >
    @error('scheduled_at')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Długość filmu w sekundach</label>
    <input type="number" min="1" name="length" required
           class="form-control"
           value="{{ old('length') ?? (isset($webinar) ? $webinar->length : 1 ) }}"
    >
    @error('length')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Powtarzanie</label>
    <select name="repeat" class="form-control">
        <option @if(isset($webinar) && empty($webinar->repeat)) selected @endif
        value=""
        >-- BRAK --
        </option>
        <option @if(isset($webinar) && $webinar->repeat === '1 day') selected @endif
        value="1 day">Codziennie
        </option>
        <option @if(isset($webinar) && $webinar->repeat === '1 week') selected @endif
        value="1 week">Co tydzień
        </option>
        <option @if(isset($webinar) && $webinar->repeat === '1 month') selected @endif
        value="1 month">Co miesiąc
        </option>
        <option @if(isset($webinar) && $webinar->repeat === '1 year') selected @endif
        value="1 year">Co rok
        </option>
    </select>
    @error('length')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
