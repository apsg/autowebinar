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
    <label>Slug (link)</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"> {{ url('/webinar') }}/</div>
        </div>
        <input type="text" name="slug" required
               class="form-control"
               value="{{ old('slug') ?? $webinar->slug ?? '' }}"
               placeholder="slug-do-url"
        >
    </div>
    @error('slug')
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
    <datetime-picker name="scheduled_at"
                     date="{{ isset($webinar) ? $webinar->scheduled_at->toISOString() : '' }}">
    </datetime-picker>
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

<div class="form-group">
    <label>Tło webinaru</label>
    <p>Dozwolone dowolne wartości <code>background</code> CSS, np.:
        <br/> <code>background-color: #fafafa;</code>
        <br/> <code>background: linear-gradient(to right, red, blue);</code>
        <br/> <code>background-image: url('http://example.com/link/to/image.jpg);</code>
    </p>
    <div class="input-group">
        <input type="text" name="background"
               class="form-control"
               value="{{ old('background') ?? $webinar->background ?? '' }}"
        >
    </div>
    @error('background')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Grafika prezentera</label>
    <input type="text" name="presenter_url"
           class="form-control"
           value="{{ old('presenter_url') ?? $webinar->presenter_url ?? '' }}"
           placeholder="url"
    >
    @error('presenter_url')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Opis prezentera</label>
    <p>Możesz tutaj używać <a href="https://pl.wikipedia.org/wiki/Markdown" target="_blank"> Markdown </a></p>
    @error('presenter_description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea name="presenter_description"
              class="form-control"
              placeholder="Opis prezentera."
              style="height: 200px"
    >{{ old('presenter_description') ?? $webinar->presenter_description ?? '' }}</textarea>
</div>

<div class="form-group">
    <label>Logo</label>
    <input type="text" name="logo"
           class="form-control"
           value="{{ old('logo') ?? $webinar->logo ?? '' }}"
           placeholder="url"
    >
    @error('logo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>