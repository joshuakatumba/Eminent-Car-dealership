# Blog Post Image Upload Feature

## Overview
The blog post system now supports image uploads for featured images. Users can upload images directly from their computer instead of having to provide external URLs.

## Features

### Image Upload Capabilities
- **Supported Formats**: JPEG, PNG, JPG, GIF, WEBP
- **Maximum File Size**: 2MB
- **Storage Location**: `storage/app/public/blog-images/`
- **File Naming**: Timestamp + sanitized original filename

### User Interface Features
- **Image Preview**: Real-time preview of selected images before upload
- **Current Image Display**: Shows existing images in edit forms
- **Thumbnail Display**: Blog post listings show image thumbnails
- **Fallback Images**: Default placeholder images when no image is uploaded

## How to Use

### Creating a New Blog Post
1. Navigate to Admin Panel → Content Management
2. Click "Add New Post"
3. Fill in the post details (title, content, etc.)
4. In the "Featured Image" section:
   - Click "Choose File" to select an image
   - Preview the image before uploading
   - The image will be automatically uploaded when you save the post

### Editing an Existing Blog Post
1. Navigate to the blog post you want to edit
2. Click "Edit"
3. In the "Featured Image" section:
   - View the current image (if any)
   - Upload a new image to replace the current one
   - Leave the field empty to keep the current image

### Viewing Images
- **Admin Panel**: Images are displayed in the content listing with thumbnails
- **Front-end**: Images are displayed in blog post listings and individual post pages
- **Responsive**: Images automatically resize for different screen sizes

## Technical Details

### File Storage
- Images are stored in `storage/app/public/blog-images/`
- Files are accessible via `/storage/blog-images/filename`
- The storage link must be created: `php artisan storage:link`

### Database
- The `blog_posts` table has a `featured_image` column
- Stores the relative path to the uploaded image
- Supports both uploaded files and external URLs

### Validation
- File type validation (images only)
- File size validation (max 2MB)
- Filename sanitization for security

### Error Handling
- Graceful error handling for upload failures
- User-friendly error messages
- Form data preservation on errors

## Security Features
- **Filename Sanitization**: Removes special characters from filenames
- **File Type Validation**: Only allows image files
- **Size Limits**: Prevents large file uploads
- **Secure Storage**: Files stored outside web root

## Troubleshooting

### Common Issues
1. **Images not displaying**: Check if storage link exists (`php artisan storage:link`)
2. **Upload fails**: Check file size and format
3. **Permission errors**: Ensure storage directory is writable

### File Permissions
```bash
chmod -R 755 storage/
chmod -R 755 public/storage/
```

## Future Enhancements
- Image resizing and optimization
- Multiple image support
- Image cropping tools
- CDN integration
- Image compression
