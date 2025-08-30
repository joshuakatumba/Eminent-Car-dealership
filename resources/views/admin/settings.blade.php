@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">System Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">General Settings</h5>
                                
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                           id="site_name" name="site_name" 
                                           value="{{ old('site_name', $settings['site_name'] ?? 'Car Dealership') }}">
                                    @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="site_description" class="form-label">Site Description</label>
                                    <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                              id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                                    @error('site_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                           id="contact_email" name="contact_email" 
                                           value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                           id="contact_phone" name="contact_phone" 
                                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Business Settings</h5>
                                
                                <div class="mb-3">
                                    <label for="business_address" class="form-label">Business Address</label>
                                    <textarea class="form-control @error('business_address') is-invalid @enderror" 
                                              id="business_address" name="business_address" rows="3">{{ old('business_address', $settings['business_address'] ?? '') }}</textarea>
                                    @error('business_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="business_hours" class="form-label">Business Hours</label>
                                    <input type="text" class="form-control @error('business_hours') is-invalid @enderror" 
                                           id="business_hours" name="business_hours" 
                                           value="{{ old('business_hours', $settings['business_hours'] ?? 'Monday - Friday: 9:00 AM - 6:00 PM') }}">
                                    @error('business_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                                            <label for="currency" class="form-label">Currency</label>
                        <select class="form-select @error('currency') is-invalid @enderror"
                                id="currency" name="currency">
                            <option value="UGX" {{ (old('currency', $settings['currency'] ?? 'UGX') == 'UGX') ? 'selected' : '' }}>UGX (Ugandan Shilling)</option>
                            <option value="USD" {{ (old('currency', $settings['currency'] ?? 'UGX') == 'USD') ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ (old('currency', $settings['currency'] ?? 'UGX') == 'EUR') ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ (old('currency', $settings['currency'] ?? 'UGX') == 'GBP') ? 'selected' : '' }}>GBP (£)</option>
                            <option value="CAD" {{ (old('currency', $settings['currency'] ?? 'UGX') == 'CAD') ? 'selected' : '' }}>CAD (C$)</option>
                        </select>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tax_rate" class="form-label">Tax Rate (%)</label>
                                    <input type="number" step="0.01" min="0" max="100" 
                                           class="form-control @error('tax_rate') is-invalid @enderror" 
                                           id="tax_rate" name="tax_rate" 
                                           value="{{ old('tax_rate', $settings['tax_rate'] ?? '8.5') }}">
                                    @error('tax_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">About Page Settings</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="about_title" class="form-label">About Page Title</label>
                                            <input type="text" class="form-control @error('about_title') is-invalid @enderror" 
                                                   id="about_title" name="about_title" 
                                                   value="{{ old('about_title', $settings['about_title'] ?? 'Our Story') }}">
                                            @error('about_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_1" class="form-label">About Page Paragraph 1</label>
                                    <textarea class="form-control @error('about_paragraph_1') is-invalid @enderror" 
                                              id="about_paragraph_1" name="about_paragraph_1" rows="4">{{ old('about_paragraph_1', $settings['about_paragraph_1'] ?? '') }}</textarea>
                                    @error('about_paragraph_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_2" class="form-label">About Page Paragraph 2</label>
                                    <textarea class="form-control @error('about_paragraph_2') is-invalid @enderror" 
                                              id="about_paragraph_2" name="about_paragraph_2" rows="4">{{ old('about_paragraph_2', $settings['about_paragraph_2'] ?? '') }}</textarea>
                                    @error('about_paragraph_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('about_paragraph_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_3" class="form-label">About Page Paragraph 3</label>
                                    <textarea class="form-control @error('about_paragraph_3') is-invalid @enderror" 
                                              id="about_paragraph_3" name="about_paragraph_3" rows="4">{{ old('about_paragraph_3', $settings['about_paragraph_3'] ?? '') }}</textarea>
                                    @error('about_paragraph_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">Why Choose Us Settings</h5>
                                
                                <div class="mb-3">
                                    <label for="why_choose_title" class="form-label">Why Choose Us Title</label>
                                    <input type="text" class="form-control @error('why_choose_title') is-invalid @enderror" 
                                           id="why_choose_title" name="why_choose_title" 
                                           value="{{ old('why_choose_title', $settings['why_choose_title'] ?? 'Why Choose Us') }}">
                                    @error('why_choose_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Feature 1</h6>
                                        <div class="mb-3">
                                            <label for="feature_1_title" class="form-label">Title</label>
                                            <input type="text" class="form-control @error('feature_1_title') is-invalid @enderror" 
                                                   id="feature_1_title" name="feature_1_title" 
                                                   value="{{ old('feature_1_title', $settings['feature_1_title'] ?? '') }}">
                                            @error('feature_1_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_1_description" class="form-label">Description</label>
                                            <textarea class="form-control @error('feature_1_description') is-invalid @enderror" 
                                                      id="feature_1_description" name="feature_1_description" rows="3">{{ old('feature_1_description', $settings['feature_1_description'] ?? '') }}</textarea>
                                            @error('feature_1_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_1_icon" class="form-label">Icon Path</label>
                                            <input type="text" class="form-control @error('feature_1_icon') is-invalid @enderror" 
                                                   id="feature_1_icon" name="feature_1_icon" 
                                                   value="{{ old('feature_1_icon', $settings['feature_1_icon'] ?? '') }}">
                                            @error('feature_1_icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h6>Feature 2</h6>
                                        <div class="mb-3">
                                            <label for="feature_2_title" class="form-label">Title</label>
                                            <input type="text" class="form-control @error('feature_2_title') is-invalid @enderror" 
                                                   id="feature_2_title" name="feature_2_title" 
                                                   value="{{ old('feature_2_title', $settings['feature_2_title'] ?? '') }}">
                                            @error('feature_2_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_2_description" class="form-label">Description</label>
                                            <textarea class="form-control @error('feature_2_description') is-invalid @enderror" 
                                                      id="feature_2_description" name="feature_2_description" rows="3">{{ old('feature_2_description', $settings['feature_2_description'] ?? '') }}</textarea>
                                            @error('feature_2_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_2_icon" class="form-label">Icon Path</label>
                                            <input type="text" class="form-control @error('feature_2_icon') is-invalid @enderror" 
                                                   id="feature_2_icon" name="feature_2_icon" 
                                                   value="{{ old('feature_2_icon', $settings['feature_2_icon'] ?? '') }}">
                                            @error('feature_2_icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h6>Feature 3</h6>
                                        <div class="mb-3">
                                            <label for="feature_3_title" class="form-label">Title</label>
                                            <input type="text" class="form-control @error('feature_3_title') is-invalid @enderror" 
                                                   id="feature_3_title" name="feature_3_title" 
                                                   value="{{ old('feature_3_title', $settings['feature_3_title'] ?? '') }}">
                                            @error('feature_3_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_3_description" class="form-label">Description</label>
                                            <textarea class="form-control @error('feature_3_description') is-invalid @enderror" 
                                                      id="feature_3_description" name="feature_3_description" rows="3">{{ old('feature_3_description', $settings['feature_3_description'] ?? '') }}</textarea>
                                            @error('feature_3_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_3_icon" class="form-label">Icon Path</label>
                                            <input type="text" class="form-control @error('feature_3_icon') is-invalid @enderror" 
                                                   id="feature_3_icon" name="feature_3_icon" 
                                                   value="{{ old('feature_3_icon', $settings['feature_3_icon'] ?? '') }}">
                                            @error('feature_3_icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">Email Settings</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_host" class="form-label">SMTP Host</label>
                                            <input type="text" class="form-control @error('smtp_host') is-invalid @enderror" 
                                                   id="smtp_host" name="smtp_host" 
                                                   value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}">
                                            @error('smtp_host')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_port" class="form-label">SMTP Port</label>
                                            <input type="number" class="form-control @error('smtp_port') is-invalid @enderror" 
                                                   id="smtp_port" name="smtp_port" 
                                                   value="{{ old('smtp_port', $settings['smtp_port'] ?? '587') }}">
                                            @error('smtp_port')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_username" class="form-label">SMTP Username</label>
                                            <input type="text" class="form-control @error('smtp_username') is-invalid @enderror" 
                                                   id="smtp_username" name="smtp_username" 
                                                   value="{{ old('smtp_username', $settings['smtp_username'] ?? '') }}">
                                            @error('smtp_username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_password" class="form-label">SMTP Password</label>
                                            <input type="password" class="form-control @error('smtp_password') is-invalid @enderror" 
                                                   id="smtp_password" name="smtp_password" 
                                                   value="{{ old('smtp_password', $settings['smtp_password'] ?? '') }}">
                                            @error('smtp_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">Social Media Settings</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_url" class="form-label">Facebook URL</label>
                                            <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                                   id="facebook_url" name="facebook_url" 
                                                   value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                                            @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="twitter_url" class="form-label">Twitter URL</label>
                                            <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" 
                                                   id="twitter_url" name="twitter_url" 
                                                   value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                                            @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagram_url" class="form-label">Instagram URL</label>
                                            <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" 
                                                   id="instagram_url" name="instagram_url" 
                                                   value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                                            @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                            <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" 
                                                   id="linkedin_url" name="linkedin_url" 
                                                   value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                                            @error('linkedin_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="youtube_url" class="form-label">YouTube URL</label>
                                            <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                                   id="youtube_url" name="youtube_url" 
                                                   value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}">
                                            @error('youtube_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tiktok_url" class="form-label">TikTok URL</label>
                                            <input type="url" class="form-control @error('tiktok_url') is-invalid @enderror" 
                                                   id="tiktok_url" name="tiktok_url" 
                                                   value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}">
                                            @error('tiktok_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
