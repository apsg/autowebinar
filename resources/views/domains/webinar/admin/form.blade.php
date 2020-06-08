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
