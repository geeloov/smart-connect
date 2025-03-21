document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const uploadForm = document.getElementById('uploadForm');
    const cvUpload = document.getElementById('cv-upload');
    const fileName = document.getElementById('file-name');
    const fileNameText = fileName.querySelector('.file-name-text');
    const fileSizeText = fileName.querySelector('.file-size');
    const uploadArea = document.getElementById('upload-area');
    const removeFileBtn = document.getElementById('remove-file');
    const loading = document.getElementById('loading');
    const extractBtn = document.getElementById('extract-btn');
    const resultsContainer = document.getElementById('results-container');
    const noResults = document.getElementById('no-results');
    const formattedView = document.getElementById('formatted-view');
    const rawJson = document.getElementById('raw-json');
    const jsonDisplay = document.getElementById('json-display');
    const tabFormatted = document.getElementById('tab-formatted');
    const tabRaw = document.getElementById('tab-raw');
    const copyJsonBtn = document.getElementById('copy-json');
    const jobMatchContainer = document.getElementById('job-match-container');
    const matchScore = document.getElementById('match-score');
    const matchStatus = document.getElementById('match-status');
    const matchReasoning = document.getElementById('match-reasoning');
    const missingCriteriaContainer = document.getElementById('missing-criteria-container');
    const missingCriteriaList = document.getElementById('missing-criteria-list');

    // Show selected file name
    cvUpload.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            
            // Check if file is PDF
            if (file.type !== 'application/pdf') {
                alert('Please upload a PDF file only');
                cvUpload.value = '';
                fileName.classList.add('hidden');
                uploadArea.classList.remove('hidden');
                return;
            }
            
            // Check file size (max 10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size should be less than 10MB');
                cvUpload.value = '';
                fileName.classList.add('hidden');
                uploadArea.classList.remove('hidden');
                return;
            }
            
            // Update file name and size display
            fileNameText.textContent = file.name;
            
            // Format file size
            const fileSizeKB = file.size / 1024;
            if (fileSizeKB < 1024) {
                fileSizeText.textContent = `${fileSizeKB.toFixed(1)} KB`;
            } else {
                const fileSizeMB = fileSizeKB / 1024;
                fileSizeText.textContent = `${fileSizeMB.toFixed(2)} MB`;
            }
            
            fileName.classList.remove('hidden');
            uploadArea.classList.add('hidden');
        } else {
            fileName.classList.add('hidden');
            uploadArea.classList.remove('hidden');
        }
    });

    // Handle remove file button
    removeFileBtn.addEventListener('click', function() {
        cvUpload.value = '';
        fileName.classList.add('hidden');
        uploadArea.classList.remove('hidden');
    });

    // Tab switching
    tabFormatted.addEventListener('click', function() {
        formattedView.classList.remove('hidden');
        rawJson.classList.add('hidden');
        tabFormatted.classList.add('border-indigo-500', 'text-indigo-600');
        tabFormatted.classList.remove('border-transparent', 'text-gray-500');
        tabRaw.classList.add('border-transparent', 'text-gray-500');
        tabRaw.classList.remove('border-indigo-500', 'text-indigo-600');
    });

    tabRaw.addEventListener('click', function() {
        formattedView.classList.add('hidden');
        rawJson.classList.remove('hidden');
        tabRaw.classList.add('border-indigo-500', 'text-indigo-600');
        tabRaw.classList.remove('border-transparent', 'text-gray-500');
        tabFormatted.classList.add('border-transparent', 'text-gray-500');
        tabFormatted.classList.remove('border-indigo-500', 'text-indigo-600');
    });

    // Copy JSON to clipboard
    copyJsonBtn.addEventListener('click', function() {
        navigator.clipboard.writeText(jsonDisplay.textContent)
            .then(() => {
                const originalText = copyJsonBtn.textContent;
                copyJsonBtn.textContent = 'Copied!';
                setTimeout(() => {
                    copyJsonBtn.textContent = originalText;
                }, 2000);
            })
            .catch(err => {
                console.error('Failed to copy: ', err);
            });
    });

    // Form submission
    uploadForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate form
        if (!cvUpload.files || !cvUpload.files[0]) {
            alert('Please select a PDF file');
            return;
        }
        
        // Show loading state
        loading.classList.remove('hidden');
        extractBtn.disabled = true;
        resultsContainer.classList.add('hidden');
        noResults.classList.add('hidden');
        jobMatchContainer.classList.add('hidden');
        
        // Get form data
        const formData = new FormData();
        formData.append('cv_file', cvUpload.files[0]);
        
        const jobDescription = document.getElementById('job-description').value;
        if (jobDescription.trim()) {
            formData.append('job_description', jobDescription);
        }
        
        try {
            // Call API
            const response = await fetch('/api/extract-cv', {
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            displayResults(data);
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        } finally {
            // Hide loading state
            loading.classList.add('hidden');
            extractBtn.disabled = false;
        }
    });

    // Display results function
    function displayResults(data) {
        // Show results container
        resultsContainer.classList.remove('hidden');
        noResults.classList.add('hidden');
        
        // Display raw JSON
        jsonDisplay.textContent = JSON.stringify(data, null, 2);
        
        // Clear previous formatted view
        formattedView.innerHTML = '';
        
        // Display formatted CV data
        const cvData = data.cv_data;
        
        // Personal info section
        const personalInfo = document.createElement('div');
        personalInfo.className = 'bg-light p-5 rounded-xl';
        
        const personalTitle = document.createElement('h4');
        personalTitle.className = 'font-medium text-dark mb-3';
        personalTitle.textContent = 'Personal Information';
        personalInfo.appendChild(personalTitle);
        
        const infoGrid = document.createElement('div');
        infoGrid.className = 'grid grid-cols-1 sm:grid-cols-2 gap-3';
        
        // Add basic personal info
        addInfoItem(infoGrid, 'Name', cvData.fullname || `${cvData.name || ''} ${cvData.surname || ''}`.trim());
        addInfoItem(infoGrid, 'Email', cvData.email);
        addInfoItem(infoGrid, 'Phone', cvData.phone);
        addInfoItem(infoGrid, 'Address', cvData.address);
        
        // Add social links
        if (cvData.linkedin) addInfoItem(infoGrid, 'LinkedIn', cvData.linkedin);
        if (cvData.github) addInfoItem(infoGrid, 'GitHub', cvData.github);
        if (cvData.website) addInfoItem(infoGrid, 'Website', cvData.website);
        
        personalInfo.appendChild(infoGrid);
        formattedView.appendChild(personalInfo);
        
        // Summary section
        if (cvData.summary) {
            const summary = document.createElement('div');
            summary.className = 'bg-light p-5 rounded-xl';
            
            const summaryTitle = document.createElement('h4');
            summaryTitle.className = 'font-medium text-dark mb-3';
            summaryTitle.textContent = 'Professional Summary';
            summary.appendChild(summaryTitle);
            
            const summaryText = document.createElement('p');
            summaryText.className = 'text-dark opacity-80';
            summaryText.textContent = cvData.summary;
            summary.appendChild(summaryText);
            
            formattedView.appendChild(summary);
        }
        
        // Education section
        if (cvData.education && cvData.education.length > 0) {
            const education = document.createElement('div');
            education.className = 'bg-light p-5 rounded-xl';
            
            const educationTitle = document.createElement('h4');
            educationTitle.className = 'font-medium text-dark mb-3';
            educationTitle.textContent = 'Education';
            education.appendChild(educationTitle);
            
            const educationList = document.createElement('ul');
            educationList.className = 'space-y-3';
            
            cvData.education.forEach(edu => {
                const eduItem = document.createElement('li');
                eduItem.className = 'border-l-2 border-[#B9FF66] pl-3 transition-all duration-200 hover:border-l-4';
                
                const degree = document.createElement('div');
                degree.className = 'font-medium text-dark';
                degree.textContent = edu.degree;
                eduItem.appendChild(degree);
                
                const university = document.createElement('div');
                university.className = 'text-sm text-dark opacity-80';
                university.textContent = edu.university;
                eduItem.appendChild(university);
                
                if (edu.year) {
                    const year = document.createElement('div');
                    year.className = 'text-xs text-dark opacity-60 mt-1';
                    year.textContent = edu.year;
                    eduItem.appendChild(year);
                }
                
                educationList.appendChild(eduItem);
            });
            
            education.appendChild(educationList);
            formattedView.appendChild(education);
        }
        
        // Work Experience section
        if (cvData.work_experience && cvData.work_experience.length > 0) {
            const experience = document.createElement('div');
            experience.className = 'bg-light p-5 rounded-xl';
            
            const experienceTitle = document.createElement('h4');
            experienceTitle.className = 'font-medium text-dark mb-3';
            experienceTitle.textContent = 'Work Experience';
            experience.appendChild(experienceTitle);
            
            const experienceList = document.createElement('ul');
            experienceList.className = 'space-y-4';
            
            cvData.work_experience.forEach(job => {
                const jobItem = document.createElement('li');
                jobItem.className = 'border-l-2 border-[#B9FF66] pl-3 transition-all duration-200 hover:border-l-4';
                
                const title = document.createElement('div');
                title.className = 'font-medium text-dark';
                title.textContent = job.job_title;
                jobItem.appendChild(title);
                
                const company = document.createElement('div');
                company.className = 'text-sm text-dark opacity-80';
                company.textContent = job.company;
                jobItem.appendChild(company);
                
                if (job.years) {
                    const years = document.createElement('div');
                    years.className = 'text-xs text-dark opacity-60 mb-2 mt-1';
                    years.textContent = job.years;
                    jobItem.appendChild(years);
                }
                
                if (job.responsibilities && job.responsibilities.length > 0) {
                    const respList = document.createElement('ul');
                    respList.className = 'text-sm list-disc pl-5 mt-1 text-dark opacity-80';
                    
                    job.responsibilities.forEach(resp => {
                        const respItem = document.createElement('li');
                        respItem.textContent = resp;
                        respList.appendChild(respItem);
                    });
                    
                    jobItem.appendChild(respList);
                }
                
                experienceList.appendChild(jobItem);
            });
            
            experience.appendChild(experienceList);
            formattedView.appendChild(experience);
        }
        
        // Skills section
        if (cvData.skills && cvData.skills.length > 0) {
            const skills = document.createElement('div');
            skills.className = 'bg-light p-5 rounded-xl';
            
            const skillsTitle = document.createElement('h4');
            skillsTitle.className = 'font-medium text-dark mb-3';
            skillsTitle.textContent = 'Skills';
            skills.appendChild(skillsTitle);
            
            const skillsContainer = document.createElement('div');
            skillsContainer.className = 'flex flex-wrap gap-2';
            
            cvData.skills.forEach(skill => {
                const skillBadge = document.createElement('span');
                skillBadge.className = 'bg-white text-dark px-3 py-1.5 rounded-lg text-sm border border-[#B9FF66] hover:bg-[#B9FF66] transition-colors duration-200';
                skillBadge.textContent = skill;
                skillsContainer.appendChild(skillBadge);
            });
            
            skills.appendChild(skillsContainer);
            formattedView.appendChild(skills);
        }
        
        // Certifications section
        if (cvData.certifications && cvData.certifications.length > 0) {
            const certifications = document.createElement('div');
            certifications.className = 'bg-light p-5 rounded-xl';
            
            const certTitle = document.createElement('h4');
            certTitle.className = 'font-medium text-dark mb-3';
            certTitle.textContent = 'Certifications';
            certifications.appendChild(certTitle);
            
            const certList = document.createElement('ul');
            certList.className = 'list-disc pl-5 text-dark opacity-80';
            
            cvData.certifications.forEach(cert => {
                const certItem = document.createElement('li');
                certItem.textContent = cert;
                certList.appendChild(certItem);
            });
            
            certifications.appendChild(certList);
            formattedView.appendChild(certifications);
        }
        
        // Languages section
        if (cvData.languages && cvData.languages.length > 0) {
            const languages = document.createElement('div');
            languages.className = 'bg-light p-5 rounded-xl';
            
            const langTitle = document.createElement('h4');
            langTitle.className = 'font-medium text-dark mb-3';
            langTitle.textContent = 'Languages';
            languages.appendChild(langTitle);
            
            const langContainer = document.createElement('div');
            langContainer.className = 'flex flex-wrap gap-2';
            
            cvData.languages.forEach(lang => {
                const langBadge = document.createElement('span');
                langBadge.className = 'bg-white text-dark px-3 py-1.5 rounded-lg text-sm border border-[#191A23] hover:bg-[#191A23] hover:text-[#F3F3F3] transition-colors duration-200';
                langBadge.textContent = lang;
                langContainer.appendChild(langBadge);
            });
            
            languages.appendChild(langContainer);
            formattedView.appendChild(languages);
        }
        
        // Projects section
        if (cvData.projects && cvData.projects.length > 0) {
            const projects = document.createElement('div');
            projects.className = 'bg-light p-5 rounded-xl';
            
            const projectTitle = document.createElement('h4');
            projectTitle.className = 'font-medium text-dark mb-3';
            projectTitle.textContent = 'Projects';
            projects.appendChild(projectTitle);
            
            const projectList = document.createElement('ul');
            projectList.className = 'space-y-4';
            
            cvData.projects.forEach(project => {
                const projectItem = document.createElement('li');
                projectItem.className = 'border-l-2 border-[#B9FF66] pl-3 transition-all duration-200 hover:border-l-4';
                
                const title = document.createElement('div');
                title.className = 'font-medium text-dark';
                title.textContent = project.title;
                projectItem.appendChild(title);
                
                if (project.description) {
                    const desc = document.createElement('div');
                    desc.className = 'text-sm mt-1 text-dark opacity-80';
                    desc.textContent = project.description;
                    projectItem.appendChild(desc);
                }
                
                if (project.technologies && project.technologies.length > 0) {
                    const techContainer = document.createElement('div');
                    techContainer.className = 'flex flex-wrap gap-1 mt-2';
                    
                    project.technologies.forEach(tech => {
                        const techBadge = document.createElement('span');
                        techBadge.className = 'bg-white text-dark text-xs px-2 py-1 rounded-md border border-[#191A23]';
                        techBadge.textContent = tech;
                        techContainer.appendChild(techBadge);
                    });
                    
                    projectItem.appendChild(techContainer);
                }
                
                projectList.appendChild(projectItem);
            });
            
            projects.appendChild(projectList);
            formattedView.appendChild(projects);
        }
        
        // Display job matching analysis if available
        if (data.job_matching) {
            jobMatchContainer.classList.remove('hidden');
            
            const jobMatch = data.job_matching;
            matchScore.textContent = jobMatch.match_score;
            
            // More granular match status based on score
            const score = parseInt(jobMatch.match_score);
            
            // Update the visual gauge
            const scoreGauge = document.getElementById('score-gauge');
            scoreGauge.style.width = `${score}%`;
            
            // Set gauge color based on score
            if (score >= 90) {
                scoreGauge.className = 'h-full rounded-full bg-[#B9FF66]';
            } else if (score >= 70) {
                scoreGauge.className = 'h-full rounded-full bg-green-500';
            } else if (score >= 50) {
                scoreGauge.className = 'h-full rounded-full bg-yellow-500';
            } else if (score >= 30) {
                scoreGauge.className = 'h-full rounded-full bg-orange-500';
            } else {
                scoreGauge.className = 'h-full rounded-full bg-red-500';
            }
            
            if (jobMatch.is_perfect_match) {
                matchStatus.textContent = 'Perfect Match';
                matchStatus.className = 'px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-dark';
            } else if (score >= 80) {
                matchStatus.textContent = 'Strong Match';
                matchStatus.className = 'px-3 py-1 rounded-lg text-sm font-medium bg-white text-dark border-2 border-[#B9FF66]';
            } else if (score >= 60) {
                matchStatus.textContent = 'Moderate Match';
                matchStatus.className = 'px-3 py-1 rounded-lg text-sm font-medium bg-white text-dark border border-[#B9FF66]';
            } else if (score >= 40) {
                matchStatus.textContent = 'Weak Match';
                matchStatus.className = 'px-3 py-1 rounded-lg text-sm font-medium bg-white text-dark border border-[#191A23] text-opacity-75';
            } else {
                matchStatus.textContent = 'Poor Match';
                matchStatus.className = 'px-3 py-1 rounded-lg text-sm font-medium bg-white text-red-500 border border-red-300';
            }
            
            matchReasoning.textContent = jobMatch.reasoning;
            
            // Missing criteria
            if (jobMatch.missing_criteria && jobMatch.missing_criteria.length > 0) {
                missingCriteriaContainer.classList.remove('hidden');
                missingCriteriaList.innerHTML = '';
                
                jobMatch.missing_criteria.forEach(criteria => {
                    const li = document.createElement('li');
                    li.textContent = criteria;
                    missingCriteriaList.appendChild(li);
                });
            } else {
                missingCriteriaContainer.classList.add('hidden');
            }
        } else {
            jobMatchContainer.classList.add('hidden');
        }
    }
    
    // Helper function to add info items
    function addInfoItem(container, label, value) {
        if (!value) return;
        
        const item = document.createElement('div');
        
        const itemLabel = document.createElement('div');
        itemLabel.className = 'text-xs text-dark opacity-60';
        itemLabel.textContent = label;
        item.appendChild(itemLabel);
        
        const itemValue = document.createElement('div');
        
        if (label.toLowerCase().includes('linkedin') || 
            label.toLowerCase().includes('github') || 
            label.toLowerCase().includes('website') || 
            value.startsWith('http') ||
            label.toLowerCase().includes('email') ||
            label.toLowerCase().includes('phone')) {
            
            // For all clickable items - using Tailwind only
            itemValue.className = 'flex items-center p-1 rounded-lg transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-sm group';
            
            // Create link element
            const link = document.createElement('a');
            
            // Configure link based on type
            if (label.toLowerCase().includes('email')) {
                link.href = `mailto:${value}`;
                link.title = 'Send email';
            } else if (label.toLowerCase().includes('phone')) {
                const cleanedPhone = value.replace(/[\s\(\)\-]/g, '');
                link.href = `tel:${cleanedPhone}`;
                link.title = 'Call this number';
            } else {
                // Websites and social links
                link.href = value.startsWith('http') ? value : `https://${value}`;
                link.target = '_blank';
                link.title = 'Open link in new tab';
            }
            
            link.className = 'text-dark hover:text-[#B9FF66] transition-colors duration-200';
            link.textContent = value;
            itemValue.appendChild(link);
            
            // Add appropriate icon based on type
            const icon = document.createElement('span');
            icon.className = 'transition-all duration-200 ease-in-out group-hover:scale-110 group-hover:text-[#B9FF66] ml-1';
            
            if (label.toLowerCase().includes('email')) {
                icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-dark opacity-70" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>`;
                icon.title = "Click to send email";
            } else if (label.toLowerCase().includes('phone')) {
                icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-dark opacity-70" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>`;
                icon.title = "Click to call";
            } else {
                icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-dark opacity-70" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                </svg>`;
            }
            
            itemValue.appendChild(icon);
        } else {
            itemValue.className = 'text-dark';
            itemValue.textContent = value;
        }
        
        item.appendChild(itemValue);
        container.appendChild(item);
    }
}); 