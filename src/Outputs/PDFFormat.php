<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, 'Profile of ' . $profile->getFullName(), 0, 1, 'C');

        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, 'Email: ' . $profile->getContactDetails()['email'], 0, 1);
        $this->pdf->Cell(0, 10, 'Phone: ' . $profile->getContactDetails()['phone_number'], 0, 1);
        
        // Address
        $address = implode(", ", $profile->getContactDetails()['address']);
        $this->pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
        
        // Education
        $this->pdf->Cell(0, 10, 'Education: ' . $profile->getEducation()['degree'] . ' at ' . $profile->getEducation()['university'], 0, 1);
        
        // Skills
        $this->pdf->Cell(0, 10, 'Skills: ');
        $this->pdf->Ln();
        foreach ($profile->getSkills() as $skill) {
            $this->pdf->Cell(0, 10, '- ' . $skill, 0, 1);
        }

        // Experience
        $this->pdf->Cell(0, 10, 'Experience:', 0, 1);
        foreach ($profile->getExperience() as $job) {
            $this->pdf->Cell(0, 10, '- ' . $job['job_title'] . ' at ' . $job['company'] . ' (' . $job['start_date'] . ' to ' . $job['end_date'] . ')', 0, 1);
        }

        // Certifications
        $this->pdf->Cell(0, 10, 'Certifications:', 0, 1);
        foreach ($profile->getCertifications() as $cert) {
            $this->pdf->Cell(0, 10, '- ' . $cert['name'] . ' (Earned on: ' . $cert['date_earned'] . ')', 0, 1);
        }

        // Extra-Curricular Activities
        $this->pdf->Cell(0, 10, 'Extra-Curricular Activities:', 0, 1);
        foreach ($profile->getExtracurricularActivities() as $activity) {
            $this->pdf->Cell(0, 10, '- ' . $activity['role'] . ' at ' . $activity['organization'] . ' (' . $activity['start_date'] . ' to ' . $activity['end_date'] . ')', 0, 1);
        }

        // Languages
        $this->pdf->Cell(0, 10, 'Languages:', 0, 1);
        foreach ($profile->getLanguages() as $language) {
            $this->pdf->Cell(0, 10, '- ' . $language['language'] . ' (Proficiency: ' . $language['proficiency'] . ')', 0, 1);
        }

        // References
        $this->pdf->Cell(0, 10, 'References:', 0, 1);
        foreach ($profile->getReferences() as $reference) {
            $this->pdf->Cell(0, 10, '- ' . $reference['name'] . ', ' . $reference['position'] . ' at ' . $reference['company'] . ' (Email: ' . $reference['email'] . ', Phone: ' . $reference['phone_number'] . ')', 0, 1);
        }
    }

    public function render()
    {
        return $this->pdf->Output();
    }
}
